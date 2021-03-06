$(document).ready(function () {

// Order level shipping and discoutn localStorage 
if (podiscount = localStorage.getItem('podiscount')) {
    $('#podiscount').val(podiscount);
}
$('#potax2').change(function (e) {
    localStorage.setItem('potax2', $(this).val());
});
if (potax2 = localStorage.getItem('potax2')) {
    $('#potax2').select2("val", potax2);
}
$('#postatus').change(function (e) {
    localStorage.setItem('postatus', $(this).val());
});
if (postatus = localStorage.getItem('postatus')) {
    $('#postatus').select2("val", postatus);
}

var old_shipping;
var order_discount = 0;
$('#poshipping').focus(function () {
    old_shipping = $(this).val();
}).change(function () {
    if (!is_numeric($(this).val())) {
        $(this).val(0);
        //bootbox.alert(lang.unexpected_value);
        return;
    } else {
        shipping = $(this).val() ? parseFloat($(this).val()) : '0';
    }
    localStorage.setItem('poshipping', shipping);
    var gtotal = ((total + invoice_tax) - order_discount) + shipping;
    $('#gtotal').text(formatPurDecimal(gtotal));
    $('#tship').text(formatPurDecimal(shipping));
	loadItems();
});
if (poshipping = localStorage.getItem('poshipping')) {
    shipping = parseFloat(poshipping);
    $('#poshipping').val(shipping);
}

if (slpayment_status = localStorage.getItem('slpayment_status')) {
	$('#slpayment_status').select2("val", slpayment_status);
	var ps = slpayment_status;
	if (ps == 'partial' || ps == 'paid') {
		$('#payments').slideDown();
		$('#pcc_no_1').focus();
		$(".bank_control").show();
	} else {
		$('#payments').slideUp();
		
	}
	if(slpayment_status == "due" || slpayment_status == "pending"){
		$(".hidd").hide();
	}
}
	
$(document).on('load', function(){
	$(".paid_by").trigger('change');
	$('#slpayment_status').trigger('change');
	
	checkDeposit();
	
});

$(document).on('change', '.paid_by', function () {
	var p_val = $(this).val();
	localStorage.setItem('paid_by', p_val);
	$('#rpaidby').val(p_val);
	if (p_val == 'cash' ||  p_val == 'other' || p_val == 'western union' || p_val == 'bank transfer') {
		$('.pcheque_1').hide();
		$('.pcc_1').hide();
		$('.depreciation_1').hide();
		$('.pcash_1').show();
		$('#payment_note_1').focus();
		$(".bank_control").show();
	} else if (p_val == 'CC') {
		$('.pcheque_1').hide();
		$('.pcash_1').hide();
		$('.depreciation_1').hide();
		$('.pcc_1').show();
		$('#pcc_no_1').focus();
		$(".bank_control").show();
		
	} else if (p_val == 'Cheque') {
		$('.pcc_1').hide();
		$('.pcash_1').hide();
		$('.depreciation_1').hide();
		$('.pcheque_1').show();
		$('#cheque_no_1').focus();
		$(".bank_control").show();
		
	} else if (p_val == 'depreciation') {
		$('.pcheque_1').hide();
		$('.pcash_1').hide();
		$('.pcc_1').hide();
		$('.depreciation_1').show();
		$('#rate_1').focus();
		$(".bank_control").show();
	} else {
		$('.pcheque_1').hide();
		$('.depreciation_1').hide();
		$('.pcc_1').hide();
		$('.pcash_1').hide();
		
	}
	if (p_val == 'gift_card') {
		$('.gc').show();
		$('.ngc').hide();
		$('#gift_card_no').focus();
		$(".bank_control").show();
	} else {
		$('.ngc').show();
		$('.gc').hide();
		$('#gc_details').html('');
		
	}
	if(p_val == 'deposit') {
		$('.dp').show();
		$(".deposit_s").hide();
		checkDeposit();
		$(".bank_control").hide();
	}else{
		$('.dp').hide();
		$('#dp_details').html('');
		$(".deposit_s").show();
	}
}).trigger('change');

function checkDeposit() {
	var supplier_id = 0;
	if(localStorage.getItem('posupplier')){
		supplier_id = localStorage.getItem('posupplier');
	}else{
		supplier_id = $("#posupplier").val();
	}
	
	if (supplier_id != '') {
		$.ajax({
			type: "get", async: false,
			url: site.base_url + "sales/validate_deposit/" + supplier_id,
			dataType: "json",
			success: function (data) {
				if (data === false) {
					$('#deposit_no_1').parent('.form-group').addClass('has-error');
					bootbox.alert(lang('invalid_customer'));
				} else if (data.id !== null && data.id !== supplier_id) {
					$('#deposit_no_1').parent('.form-group').addClass('has-error');
					bootbox.alert(lang('this_supplier_has_no_deposit'));
				} else {
					var am = 0;
					var deposit_balance = 0;
					var amount = $("#amount_1").val()-0;
					var amount_o = $("#amount_o").val()-0;
					var paid_o = $("#paid_o").val();
					
					var balance =  (data.deposit_amount==null?0: data.deposit_amount);
					var balance_pur =  (data.pur_deposit_amount==null?0: data.pur_deposit_amount);
					
					if(amount>amount_o){
						am = amount - amount_o;
						deposit_balance = (balance_pur - am);
					}else{
						am = amount_o - amount;
						deposit_balance = (balance_pur + am);
					}
					if(paid_o != "deposit"){
						deposit_balance = (balance_pur - amount);
					}
					$('#dp_details').html('<small>Supplier Name: ' + data.name + '<br>Deposit Amount: <span class="deposit_total_amount">' + formatPurDecimal(data.real_deposit_amount) + '</span>  / Balance: <span class="actual_total_balance">' + formatPurDecimal(deposit_balance) + '</span><input type="hidden" name="deposit_amount" class="deposit_amount" value="'+balance_pur+'" > </small>');
					
					//$('#dp_details').html('<small>Supplier Name: ' + data.name + '<br>Deposit Amount: <span class="deposit_total_amount">' + data.real_deposit_amount + '</span> / Balance: <span class="deposit_total_balance">' + balance + '</span>  / Actual Balance: <span class="actual_total_balance">' + deposit_balance + '</span><input type="hidden" name="deposit_amount" class="deposit_amount" value="'+balance_pur+'" > </small>');
					
					$('#deposit_no').parent('.form-group').removeClass('has-error');
					//calculateTotals();
					//$('#amount_1').val(data.deposit_amount - amount).focus();
				}
			}
		});
	}
}



$(document).on('keyup', '#amount_1', function () {
	var am = 0;
	var us_paid = $('#amount_1').val()-0;
	var amount_o = $("#amount_o").val()-0;
	var paid_o = $("#paid_o").val();
	var deposit_amount = parseFloat($(".deposit_amount").val()-0);
	var deposit_balance = 0;
	if(us_paid>amount_o){
		am = us_paid - amount_o;
		deposit_balance = (deposit_amount - am);
	}else{
		am = amount_o - us_paid;
		deposit_balance = (deposit_amount + am);
	}
	if(paid_o != "deposit"){
		deposit_balance = (deposit_amount - us_paid);
	}
	$(".actual_total_balance").text(deposit_balance);
});


if (paid_by = localStorage.getItem('paid_by')) {
	var p_val = paid_by;
	$('.paid_by').select2("val", paid_by);
	$('#rpaidby').val(p_val);
	if (p_val == 'cash' ||  p_val == 'other' || p_val == 'western union' || p_val == 'bank transfer') {
		$('.pcheque_1').hide();
		$('.pcc_1').hide();
		$('.depreciation_1').hide();
		$('.pcash_1').show();
		$('#payment_note_1').focus();
		$(".bank_control").show();
	} else if (p_val == 'CC') {
		$('.pcheque_1').hide();
		$('.pcash_1').hide();
		$('.depreciation_1').hide();
		$('.pcc_1').show();
		$('#pcc_no_1').focus();
		$(".bank_control").show();
	} else if (p_val == 'Cheque') {
		$('.pcc_1').hide();
		$('.pcash_1').hide();
		$('.depreciation_1').hide();
		$('.pcheque_1').show();
		$('#cheque_no_1').focus();
		$(".bank_control").show();
	} else if (p_val == 'depreciation'){
		$('.pcheque_1').hide();
		$('.pcash_1').hide();
		$('.pcc_1').hide();
		$('.depreciation_1').show();
		$('#rate_1').focus();
		$(".bank_control").show();
	} else {
		$('.pcheque_1').hide();
		$('.pcc_1').hide();
		$('.depreciation_1').hide();
		$('.pcash_1').hide();
	}
	if (p_val == 'gift_card') {
		$('.gc').show();
		$('.ngc').hide();
		$('#gift_card_no').focus();
		$(".bank_control").show();
	} else {
		$('.ngc').show();
		$('.gc').hide();
		$('#gc_details').html('');
	}
	if(p_val == 'deposit') {
		$('.dp').show();
		$(".deposit_s").hide();
		checkDeposit();
		$(".bank_control").hide();
	}else{
		$('.dp').hide();
		$('#dp_details').html('');
		$(".deposit_s").show();
		
	}
}

// If there is any item in localStorage
if (localStorage.getItem('poitems')) {
    loadItems();
}

    // clear localStorage and reload
    $('#reset').click(function (e) {
        bootbox.confirm(lang.r_u_sure, function (result) {
            if (result) {
                if (localStorage.getItem('poitems')) {
                    localStorage.removeItem('poitems');
                }
                if (localStorage.getItem('podiscount')) {
                    localStorage.removeItem('podiscount');
                }
                if (localStorage.getItem('potax2')) {
                    localStorage.removeItem('potax2');
                }
                if (localStorage.getItem('poshipping')) {
                    localStorage.removeItem('poshipping');
                }
                if (localStorage.getItem('poref')) {
                    localStorage.removeItem('poref');
                }
                if (localStorage.getItem('powarehouse')) {
                    localStorage.removeItem('powarehouse');
                }
				if (localStorage.getItem('slbiller')) {
                    localStorage.removeItem('slbiller');
                }
				if (localStorage.getItem('slpayment_term')) {
                    localStorage.removeItem('slpayment_term');
                }
                if (localStorage.getItem('ponote')) {
                    localStorage.removeItem('ponote');
                }
                if (localStorage.getItem('posupplier')) {
                    localStorage.removeItem('posupplier');
                }
                if (localStorage.getItem('pocurrency')) {
                    localStorage.removeItem('pocurrency');
                }
                if (localStorage.getItem('poextras')) {
                    localStorage.removeItem('poextras');
                }
                
                if (localStorage.getItem('postatus')) {
                    localStorage.removeItem('postatus');
                }
				if (localStorage.getItem('slpayment_status')) {
                    localStorage.removeItem('slpayment_status');
                }
				
                 $('#modal-loading').show();
                 location.reload();
             }
        });
	});

	// save and load the fields in and/or from localStorage
	var $supplier = $('#posupplier'), $currency = $('#pocurrency');

	$('#poref').change(function (e) {
		localStorage.setItem('poref', $(this).val());
	});
	if (poref = localStorage.getItem('poref')) {
		$('#poref').val(poref);
	}
	$('#powarehouse').change(function (e) {
		localStorage.setItem('powarehouse', $(this).val());
	});
	
	if (powarehouse = localStorage.getItem('powarehouse')) {
		$('#powarehouse').select2("val", powarehouse);
	}
	$('#slbiller').change(function (e) {
		localStorage.setItem('slbiller', $(this).val());
	});
	if (slbiller = localStorage.getItem('slbiller')) {
		$('#slbiller').select2("val", slbiller);
	}
	
	$('#posupplier').change(function (e) {
		localStorage.setItem('posupplier', $(this).val());
	});
	if (posupplier = localStorage.getItem('posupplier')) {
		$('#posupplier').select2("val", posupplier);
	}
	
	$('#slpayment_term').change(function (e) {
		localStorage.setItem('slpayment_term', $(this).val());
	});
	if (slpayment_term = localStorage.getItem('slpayment_term')) {
		$('#slpayment_term').select2("val", slpayment_term);
	}
	
	
        $('#ponote').redactor('destroy');
        $('#ponote').redactor({
            buttons: ['formatting', '|', 'alignleft', 'aligncenter', 'alignright', 'justify', '|', 'bold', 'italic', 'underline', '|', 'unorderedlist', 'orderedlist', '|', 'link', '|', 'html'],
            formattingTags: ['p', 'pre', 'h3', 'h4'],
            minHeight: 100,
            changeCallback: function (e) {
                var v = this.get();
                localStorage.setItem('ponote', v);
            }
        });
        if (ponote = localStorage.getItem('ponote')) {
            $('#ponote').redactor('set', ponote);
        }
        $supplier.change(function (e) {
            localStorage.setItem('posupplier', $(this).val());
            $('#supplier_id').val($(this).val());
        });
		/*
        if (posupplier = localStorage.getItem('posupplier')) {
            $supplier.val(posupplier).select2({
                minimumInputLength: 1,
                data: [],
                initSelection: function (element, callback) {
                    $.ajax({
                        type: "get", async: false,
                        url: site.base_url+"suppliers/getSupplier/" + $(element).val(),
                        dataType: "json",
                        success: function (data) {
                            callback(data[0]);
                        }
                    });
                },
                ajax: {
                    url: site.base_url + "suppliers/suggestions",
                    dataType: 'json',
                    quietMillis: 15,
                    data: function (term, page) {
                        return {
                            term: term,
                            limit: 10
                        };
                    },
                    results: function (data, page) {
                        if (data.results != null) {
                            return {results: data.results};
                        } else {
                            return {results: [{id: '', text: 'No Match Found'}]};
                        }
                    }
                }
            });

		} else {
			nsSupplier();
		}
		*/

    /*$('.rexpiry').change(function (e) {
        var item_id = $(this).closest('tr').attr('data-item-id');
        poitems[item_id].row.expiry = $(this).val();
        localStorage.setItem('poitems', JSON.stringify(poitems));
    });*/
	if (localStorage.getItem('poextras')) {
		$('#extras').iCheck('check');
		$('#extras-con').show();
	}
	$('#extras').on('ifChecked', function () {
		localStorage.setItem('poextras', 1);
		$('#extras-con').slideDown();
	});
	$('#extras').on('ifUnchecked', function () {
		localStorage.removeItem("poextras");
		$('#extras-con').slideUp();
	});
	$(document).on('change', '.rexpiry', function () { 
		var item_id = $(this).closest('tr').attr('data-item-id');
		poitems[item_id].row.expiry = $(this).val();
		localStorage.setItem('poitems', JSON.stringify(poitems));
	});

	// prevent default action upon enter
	$('body').bind('keypress', function (e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			return false;
		}
	});

// Order tax calcuation 
if (site.settings.tax2 != 0) {
    $('#potax2').change(function () {
        localStorage.setItem('potax2', $(this).val());
        loadItems();
        return;
    });
}

// Order discount calcuation 
var old_podiscount;
$('#podiscount').focus(function () {
    old_podiscount = $(this).val();
}).change(function () {
    if (is_valid_discount($(this).val())) {
		
        localStorage.removeItem('podiscount');
        localStorage.setItem('podiscount', $(this).val());
        loadItems();
        return;
    } else {
        $(this).val(old_podiscount);
        bootbox.alert(lang.unexpected_value);
        return;
    }
});


    /* ---------------------- 
     * Delete Row Method 
     * ---------------------- */

	$(document).on('click', '.podel', function () {
		var row = $(this).closest('tr');
		var item_id = row.attr('data-item-id');
		if (site.settings.product_discount == 1) {
			idiscount = formatPurDecimal($.trim(row.children().children('.rdiscount').text()));
			total_discount -= idiscount;
		}
		if (site.settings.tax1 == 1) {
			var itax = row.children().children('.sproduct_tax').text();
			var iptax = itax.split(') ');
			var iproduct_tax = parseFloat(iptax[1]);
			product_tax -= iproduct_tax;
		}
		var iqty = parseFloat(row.children().children('.rquantity').val());
		var icost = parseFloat(row.children().children('.rcost').val());
		an -= 1;
		total -= (iqty * icost);
		count -= iqty;

		var gtotal = ((total + product_tax + formatPurDecimal(invoice_tax)) - total_discount) + shipping;
		$('#total').text(formatPurDecimal(total));
		$('#tds').text(formatPurDecimal(total_discount));
		$('#titems').text(count - 1);
		$('#ttax1').text(formatPurDecimal(product_tax));
		$('#gtotal').text(formatPurDecimal(gtotal));
		if (count == 1) {
        //$('#posupplier').select2('readonly', false);
            //$('#pocurrency').select2('readonly', false);
        }
        //console.log(poitems[item_id].row.name + ' is being removed.');
        delete poitems[item_id];
        localStorage.setItem('poitems', JSON.stringify(poitems));
        row.remove();
		loadItems();
		
		checkDeposit();
    });
	
    /* -----------------------
     * Edit Row Modal Hanlder 
     ----------------------- */
     $(document).on('click', '.edit', function (){
        var row = $(this).closest('tr');
        var row_id = row.attr('id');

        item_id = row.attr('data-item-id');
        item = poitems[item_id];
		if(row.children().children('.received').val() === NaN || row.children().children('.received').val() === undefined) {
			var qty = row.children().children('.rquantity').val(); 
		}else {
			var qty = row.children().children('.received').val();
		}
        var product_option = row.children().children('.roption').val(),
        unit_cost = formatPurDecimal(row.children().children('.realucost').val()),
        realcost = formatPurDecimal(row.children().children('.realcost').val()),
        discount = row.children().children('.rdiscount').val(),
        supplier = row.children().children('.rsupplier_id').val();
		tax_method 	 = row.children().children('.tax_method').val();
        var net_cost = unit_cost;
        $('#prModalLabel').text(item.row.name + ' (' + item.row.code + ')');
		var code = item.row.code;

        var results = [];
         $.ajax({
			type: "get",
			dataType: "json",
			async: false,
			url: site.base_url+"purchases/getSupplierProduct/",
			data: { code: code},
			success: function (data) {
                results = data;
			}
		});
        $('#psupplier').select2({
            data : results
        });
        $('#psupplier').select2('val', item.supplier_id);
		
        if (site.settings.tax1) {
            $('#ptax').select2('val', item.row.tax_rate);
            $('#old_tax').val(item.row.tax_rate);
            var item_discount = 0, ds = discount ? discount : '0';
            if (ds.indexOf("%") !== -1) {
                var pds = ds.split("%");
                if (!isNaN(pds[0])) {
                    item_discount = parseFloat(((unit_cost) * parseFloat(pds[0])) / 100);
                } else {
                    item_discount = parseFloat(ds/qty);
                }
            } else {
                item_discount = parseFloat(ds/qty);
            }
			
			net_cost = net_cost  - item_discount

            var pr_tax = item.row.tax_rate, pr_tax_val = 0;			
            if (pr_tax !== null && pr_tax != 0) {				
                $.each(tax_rates, function () {
                    if(this.id == pr_tax){
                        if (this.type == 1) {

                            if (poitems[item_id].row.tax_method == 0) {
                                pr_tax_val = formatPurDecimal(((unit_cost - item_discount) * parseFloat(this.rate)) / (100 + parseFloat(this.rate)));
                                pr_tax_rate = formatPurDecimal(this.rate) + '%';
                                net_cost -= pr_tax_val;
                            } else {
                                pr_tax_val = formatPurDecimal(((unit_cost - item_discount) * parseFloat(this.rate)) / 100);
                                pr_tax_rate = formatPurDecimal(this.rate) + '%';
                            }

                        } else if (this.type == 2) {

                            pr_tax_val = parseFloat(this.rate);
                            pr_tax_rate = this.rate;

                        }
                    }
                });
            }
        }
		
		if (site.settings.product_serial !== 0) {
            $('#pserial').val(row.children().children('.rserial').val());
        }
		 
        var opt = '<p style="margin: 12px 0 0 0;">n/a</p>';
		 
		if(site.settings.attributes == 1){ 
			if(item.options !== false) {
				$.each(item.options,function(index,value){ 
					$("#qty_unit").val(value["qty_unit"]);
				});
				var o = 1;
				opt = $("<select id=\"poption\" name=\"poption\" class=\"form-control select\" />");
				$.each(item.options, function () {
					if(o == 1) {
						if(product_option == '') { product_variant = this.id; } else { product_variant = product_option; }
					}
					$("<option />", {value: this.id, title: this.qty_unit,text: this.name}).appendTo(opt);
					o++;
				});
			} 
		}
        
        $('#poptions-div').html(opt);
        $('select.select').select2({minimumResultsForSearch: 6});
        $('#pquantity').val(qty);
		$('#realcost').val(realcost);
        $('#psupplier').val(psupplier);
        $('#old_qty').val(qty);
        $('#pcost').val(unit_cost);
        $('#punit_cost').val(formatPurDecimal(parseFloat(unit_cost)+parseFloat(pr_tax_val)));
        $('#poption').select2('val', item.row.option);
        $('#old_cost').val(unit_cost);
		$('#tax_method').select2('val', tax_method);
        $('#row_id').val(row_id);
        $('#item_id').val(item_id);
        $('#pexpiry').val(row.children().children('.rexpiry').val());
        $('#pdiscount').val(discount);
        $('#net_cost').text(formatPurDecimal(net_cost));
        $('#pro_tax').text(formatPurDecimal(pr_tax_val));
        $('#prModal').appendTo("body").modal('show');

    });
     
    $('#prModal').on('shown.bs.modal', function (e) {
        if($('#poption').select2('val') != '') {
            $('#poption').select2('val', product_variant);
            product_variant = 0;
        }
    });
	$(document.body).on("change","#poption",function(){
		var qty_unit = $('option:selected', this).attr('title'); 
		var net_cost = $('#realcost').val(); 
		$("#qty_unit").val(qty_unit);
		var total_net_cost = '';
		total_net_cost = parseFloat(net_cost) * parseFloat(qty_unit); 
		$('#pcost').val(total_net_cost);
		$('#net_cost').text(total_net_cost);	   
    });
	  
	$(document).on('change','.rdiscount',function(){
		var row = $(this).parent().parent();
		var item_id = row.attr('data-item-id');
		var item = poitems[item_id];
		var ds   = 0;
		if (is_valid_discount($(this).val())) {
			ds   = $(this).val();
		}else{
			ds   = row.find('.rdiscount').val() ? row.find('.rdiscount').val() : '0';
			bootbox.alert(lang.unexpected_value);
		}

		poitems[item_id].row.discount = ds;  
		localStorage.setItem('poitems', JSON.stringify(poitems));
		loadItems();
	});
	
    $(document).on('change', '#pcost, #ptax, #pdiscount, #pquantity', function () {
		var row 		= $('#' + $('#row_id').val());
        var item_id 	= row.attr('data-item-id');
        var unit_cost 	= parseFloat($('#pcost').val());
		var qty 		= parseFloat($('#pquantity').val());
        var item 		= poitems[item_id];
		var tax_method  = $('#tax_method').val();
        var ds 			= $('#pdiscount').val() ? $('#pdiscount').val() : '0';
        if (ds.indexOf("%") !== -1) {
            var pds = ds.split("%");
            if (!isNaN(pds[0])) {
                item_discount = parseFloat(((unit_cost) * parseFloat(pds[0])) / 100);
            } else {
                item_discount = parseFloat(ds/qty);
            }
        } else {
            item_discount = parseFloat(ds/qty);
        }
		
       	unit_cost -= item_discount;
        var pr_tax 		= $('#ptax').val(), item_tax_method = (tax_method ? tax_method : item.row.tax_method);
        var pr_tax_val = 0, pr_tax_rate = 0;
        if (pr_tax !== null && pr_tax != 0) {
            $.each(tax_rates, function () {
                if(this.id == pr_tax){
                    if (this.type == 1) {

                        if (item_tax_method == 0) {
                            pr_tax_val = formatPurDecimal(((unit_cost) * parseFloat(this.rate)) / (100 + parseFloat(this.rate)));
                            pr_tax_rate = formatPurDecimal(this.rate) + '%';
                            unit_cost -= pr_tax_val;
                        } else {
                            pr_tax_val = formatPurDecimal(((unit_cost) * parseFloat(this.rate)) / 100);
                            pr_tax_rate = formatPurDecimal(this.rate) + '%';
                        }
						
                    } else if (this.type == 2) {

                        pr_tax_val = parseFloat(this.rate);
                        pr_tax_rate = this.rate;

                    }
                }
            });
        }
        $('#net_cost').text(formatPurDecimal(unit_cost));
        $('#pro_tax').text(formatPurDecimal(pr_tax_val));
    });
	
	$(document).on('change', '#tax_method', function(){
		var row 		= $('#' + $('#row_id').val());
        var item_id 	= row.attr('data-item-id');
		var qty 		= $('#pquantity').val();
		var tax_method  = $(this).val();
        var unit_cost 	= parseFloat($('#pcost').val());
        var item 		= poitems[item_id];
        var ds 			= $('#pdiscount').val() ? $('#pdiscount').val() : '0';
		if (ds.indexOf("%") !== -1) {
            var pds 	= ds.split("%");
            if (!isNaN(pds[0])) {
                item_discount = parseFloat(((unit_cost) * parseFloat(pds[0])) / 100);
            } else {
                item_discount = parseFloat(ds/qty);
            }
        } else {
            item_discount = parseFloat(ds/qty);
        }
		
       	unit_cost 	   -= item_discount;
		
        var pr_tax 		= $('#ptax').val();
		var item_tax_method = tax_method ? tax_method : item.row.tax_method;
        var pr_tax_val 	= 0, pr_tax_rate = 0;
        if (pr_tax !== null && pr_tax != 0) {
            $.each(tax_rates, function () {
                if(this.id == pr_tax){
                    if (this.type == 1) {						
                        if (item_tax_method == 0) {
                            pr_tax_val = formatPurDecimal(((unit_cost) * parseFloat(this.rate)) / (100 + parseFloat(this.rate)));
                            pr_tax_rate = formatPurDecimal(this.rate) + '%';
                            unit_cost -= pr_tax_val;
                        } else {
                            pr_tax_val = formatPurDecimal(((unit_cost) * parseFloat(this.rate)) / 100);
                            pr_tax_rate = formatPurDecimal(this.rate) + '%';
                        }						
                    } else if (this.type == 2) {						
                        pr_tax_val = parseFloat(this.rate);
                        pr_tax_rate = this.rate;

                    }
                }
            });
        }		
        $('#net_cost').text(formatPurDecimal(unit_cost));
        $('#pro_tax').text(formatPurDecimal(pr_tax_val));
		
	});

    /* -----------------------
     * Edit Row Method 
     ----------------------- */
     $(document).on('click', '#editItem', function () {
        var row = $('#' + $('#row_id').val());
        var item_id = row.attr('data-item-id'), new_pr_tax = $('#ptax').val(), new_pr_tax_rate = {};
		var ser_arr = [];
		var tax_method 	= $('#tax_method').val();
        if (new_pr_tax) {
            $.each(tax_rates, function () {
                if (this.id == new_pr_tax) {
                    new_pr_tax_rate = this;
                }
            });
        }
		var input = '';
		$(".serial_no").each(function() {
			ser_arr += $(this).val()+'|';
		});
        var new_pr_supplier = $('#psupplier').val(), new_pr_supplier_name = $('#psupplier option:selected').text();
		if(poitems[item_id].row.received === null || poitems[item_id].row.received === NaN || poitems[item_id].row.received === undefined) {
			poitems[item_id].row.qty = parseFloat($('#pquantity').val());
		}else {
			poitems[item_id].row.received = parseFloat($('#pquantity').val());
		}
        poitems[item_id].row.real_unit_cost = parseFloat($('#pcost').val()),
		poitems[item_id].row.cost 		= parseFloat($('#pcost').val()),
		poitems[item_id].row.net_cost 	= parseFloat($('#pcost').val()),
        poitems[item_id].row.tax_rate 	= new_pr_tax,
        poitems[item_id].tax_rate 		= new_pr_tax_rate,
        poitems[item_id].row.discount 	= $('#pdiscount').val() ? $('#pdiscount').val() : '0',
        poitems[item_id].row.option 	= $('#poption').val(),
        poitems[item_id].supplier_id 	= $('#psupplier').val(),
		poitems[item_id].row.tax_method = tax_method;
        poitems[item_id].row.expiry 	= $('#pexpiry').val() ? $('#pexpiry').val() : '';
		poitems[item_id].row.serial 	= ser_arr;
        localStorage.setItem('poitems', JSON.stringify(poitems));
        $('#prModal').modal('hide');
        loadItems();
        return;
    });
	
	
	/* -----------------------
	 * Product option change
	 ----------------------- */
	/*$(document).on('change', '#poption', function () {
		var row = $('#' + $('#row_id').val()), opt = $(this).val();
		var item_id = row.attr('data-item-id');
		var item = poitems[item_id];
		if(item.options !== false) {
			$.each(item.options, function () {
				if(this.id == opt && this.cost != 0 && this.cost != '' && this.cost != null) {
					//$('#pcost').val(this.cost);
					//$("#net_cost").text(formatPurDecimal(this.cost));
				}
			});
		}
	});
	*/
    /* ------------------------------
     * Show manual item addition modal 
     ------------------------------- */
     $(document).on('click', '#addManually4', function (e) {
		  if ($('#powarehouse').val() && $('#posupplier').val()) {
				  var sup = $("#posupplier").val();
					var wh = $("#powarehouse").val();
				 localStorage.setItem('posupplier', sup);
				 localStorage.setItem('powarehouse', wh);
				$('#posupplier').select2("readonly", true);
				$('#powarehouse').select2("readonly", true);
			} else {
				bootbox.alert(lang.select_above);
				item = null;
				return false;
			}
		$('#mnet_price').text('0.00');
		$('#mpro_tax').text('0.00');
        $('#mModal4').appendTo("body").modal('show');
        return false;
    });

    /* --------------------------
     * Edit Row Quantity Method 
     -------------------------- */
     var old_row_qty;
     var old_row_rqty;
     $(document).on("focus", '.rquantity, .received', function () {
		var tr = $(this).closest('tr');
        old_row_qty = tr.find('.rquantity').val();
		old_row_rqty = tr.find('.received').val();
		
    }).on("change", '.rquantity, .received', function () {
        var row = $(this).closest('tr');
        if (!is_numeric($('.rquantity').val()) && !is_numeric($('.received').val())) {
            row.find('.rquantity').val(old_row_qty);
            row.find('.received').val(old_row_rqty);
            bootbox.alert(lang.unexpected_value);
            return;
        }
        var new_qty = parseFloat(row.find('.rquantity').val()), new_rqty = parseFloat(((row.find('.received').val() != NaN || row.find('.received').val() > 0)? row.find('.received').val():0)),
        item_id 						= row.attr('data-item-id');
        poitems[item_id].row.qty 		= new_qty; //alert(item_id +"###"+ new_rqty);
        poitems[item_id].row.received 	= new_rqty;
        localStorage.setItem('poitems', JSON.stringify(poitems));
        loadItems();
		
		//checkDeposit();
    });
	
	
	$('.rquantity').bind('keypress', function (e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			$("#add_item").focus();
		}
	});

    /* --------------------------
     * Edit Row Cost Method 
     -------------------------- */
     var old_cost;
     $(document).on("focus", '.rcost', function () {
        old_cost = $(this).val();
		
    }).on("change", '.rcost', function () {
        var row = $(this).closest('tr');
        if(!is_numeric($(this).val())){
			if($(this).val() == ''){
				$(this).val(0);
			}else{
				$(this).val(old_cost);
				bootbox.alert(lang.unexpected_value);
			}
            return;
		}
        var new_cost = parseFloat($(this).val());
        item_id = row.attr('data-item-id');
        //poitems[item_id].row.cost = new_cost;
		poitems[item_id].row.real_unit_cost = new_cost;
		poitems[item_id].row.unit_cost = new_cost;
		poitems[item_id].row.cost = new_cost;
		poitems[item_id].row.net_cost = new_cost;
        localStorage.setItem('poitems', JSON.stringify(poitems));
        loadItems();
		
		///checkDeposit();
    });

	var old_price = 0;
	$(document).on('focus', '.rprice', function(){
		old_price = $(this).val();
	}).on('change', '.rprice', function(){
		var row = $(this).closest('tr');
		if(!is_numeric($(this).val())){
			if($(this).val() == ''){
				$(this).val(0);
			}else{
				$(this).val(old_price);
				bootbox.alert(old_price);
			}
            return;
		}
		var new_price = parseFloat($(this).val());

        item_id = row.attr('data-item-id');
		poitems[item_id].row.price = new_price;
        localStorage.setItem('poitems', JSON.stringify(poitems));
        loadItems();
		//checkDeposit();
	});
    
    $(document).on("click", '#removeReadonly', function () { 
     $('#posupplier').select2('readonly', false); 
     return false;
 });
    
});
/* -----------------------
 * Misc Actions
 ----------------------- */

// hellper function for supplier if no localStorage value
/*function nsSupplier() {
    $('#posupplier').select2({
        minimumInputLength: 1,
        ajax: {
            url: site.base_url + "suppliers/suggestions",
            dataType: 'json',
            quietMillis: 15,
            data: function (term, page) {
                return {
                    term: term,
                    limit: 10
                };
            },
            results: function (data, page) {
                if (data.results != null) {
                    return {results: data.results};
                } else {
                    return {results: [{id: '', text: 'No Match Found'}]};
                }
            }
        }
    });
}
*/

function loadItems() {
    if (localStorage.getItem('poitems')) {
        total = 0;
        count = 1;
        an = 1;
        product_tax = 0;
        invoice_tax = 0;
        product_discount = 0;
        order_discount = 0;
        total_discount = 0;
        $("#poTable tbody").empty();
        poitems = JSON.parse(localStorage.getItem('poitems'));

		var poid = localStorage.getItem('poid');
		
		var no_ = 1;
		var purchase_price = 0;
		var purchase_cost  = 0;
		if(gp){
			purchase_price = gp["purchases-price"];
			purchase_cost  = gp["purchases-cost"];
		}	
		
		//$('#powarehouse').select2("readonly", true);
		
		if(localStorage.getItem('order_ref')){
			$('#posupplier').select2("readonly", true);
		}
		/*if(localStorage.getItem('edit_status')){
			$('#slpayment_term').select2("readonly", false);
			$('#slbiller').select2("readonly", false);
		}else{
			
			$('#slpayment_term').select2("readonly", true);
			$('#slbiller').select2("readonly", true);
		}*/
		
        $.each(poitems, function () {
			
            var item = this;
            var item_id = site.settings.item_addition == 1 ? item.item_id : item.id;
            poitems[item_id] = item;

            var product_id 		= item.row.id,
			    item_type 		= item.row.type,
			    combo_items 	= item.combo_items,
			    item_cost 		= item.row.cost,
			    item_qty 		= (item.row.type == 'service' ? 1 : item.row.qty),
			    item_bqty 		= item.row.quantity_balance,
			    item_expiry 	= item.row.expiry,
			    item_tax_method = item.row.tax_method,
			    item_ds 		= item.row.discount,
			    item_discount 	= 0,
			    item_option 	= item.row.option,
			    item_code 		= item.row.code,
			    item_name 		= item.row.name.replace(/"/g, "&#034;").replace(/'/g, "&#039;"),
			    serial_no 		= item.row.serial;
            
			var qty_received 	= (item.row.received > 0) ? item.row.received : item.row.qty;
            var item_supplier_part_no = item.row.supplier_part_no ? item.row.supplier_part_no : '';
            var supplier = localStorage.getItem('posupplier'), belong = false;
            var type = item.row.type;
            var supplier_name = '';
            var supplier_id = item.supplier_id?item.supplier_id:'';
			var create_order_id = item.create_order_id;
			var create_id = item.create_id;
			var pur_id = item.purid;
            if (supplier == item.row.supplier1) {
                belong = true;
            } else
            if (supplier == item.row.supplier2) {
                belong = true;
            } else
            if (supplier == item.row.supplier3) {
                belong = true;
            } else
            if (supplier == item.row.supplier4) {
                belong = true;
            } else
            if (supplier == item.row.supplier5) {
                belong = true;
            }
			
			var disable = '';
            if(serial_no == null){
                disable = 'sp';
            }
            if(site.settings.purchase_serial == 1){
                if(disable == 'sp'){
                    $('#add_pruchase').attr('disabled', 'disabled');
                }else{
                    $('#add_pruchase').removeAttr('disabled');
                }
            }
			
			//alert(JSON.stringify(item));
			
            var unit_cost = item.row.net_cost?item.row.net_cost:0; 
            var last_cost = item.row.cost;
            var net_unit_cost = item.row.net_cost?item.row.net_cost:0;
            var checkNetCost = 'net_cost' in item.row;
			
			//console.log(unit_cost);
			
            if(checkNetCost == false){
                net_unit_cost = item.row.cost?item.row.cost:0;
            }
            var ds = item_ds ? item_ds : '0';
			
            if (ds.indexOf("%") !== -1) {
                var pds = ds.split("%");
                if (!isNaN(pds[0])) {
					item_discount = formatDecimal(parseFloat(((unit_cost) * parseFloat(pds[0])) / 100)) ;
				} else {
                    item_discount = formatPurDecimal(ds) / (qty_received == item_qty? item_qty:qty_received);
                }
            } else {
				if(item_tax_method == 0){
					item_discount = (parseFloat(ds) / (qty_received == item_qty? item_qty:qty_received));
				}else{
					item_discount = (parseFloat(ds) / (qty_received == item_qty? item_qty:qty_received));
				}
			
            }
			
			product_discount += parseFloat(item_discount * (qty_received == item_qty? item_qty:qty_received));
			
            unit_cost = (unit_cost-item_discount);
			
			
            price = (item.row.price ? formatPurDecimal(item.row.price) : 0); 
            var pr_tax = item.tax_rate;
            var pr_tax_val = 0, pr_tax_rate = 0;
			
			if (site.settings.tax1 == 1) {
				if (pr_tax !== false) {
					if (pr_tax.type == 1) {

						if (item_tax_method == '0') {
							pr_tax_val = ((unit_cost) * parseFloat(pr_tax.rate)) / (100 + parseFloat(pr_tax.rate));
							pr_tax_rate = formatDecimal(pr_tax.rate) + '%';
						} else {
							pr_tax_val = ((unit_cost) * parseFloat(pr_tax.rate)) / 100;
							pr_tax_rate = formatDecimal(pr_tax.rate) + '%';
						}

					} else if (pr_tax.type == 2) {

						pr_tax_val = pr_tax.rate;
						pr_tax_rate = pr_tax.rate;

					}
					product_tax += pr_tax_val * (qty_received == item_qty? item_qty:qty_received);
				}
			}
			
            item_cost = item_tax_method == 0 ? (unit_cost-pr_tax_val) : (unit_cost);
			
			item_costs = item_tax_method == 0 ? formatPurDecimal(net_unit_cost-pr_tax_val) : formatPurDecimal(net_unit_cost);
			
            unit_cost = (unit_cost+item_discount);
            var sel_opt = '';
            var option_qty_unit = '';
            
            $.each(item.options, function () {
                if(this.id == item_option) {
                    sel_opt = this.name;
                    option_qty_unit = this.qty_unit;
                    //item_cost = unit_cost * option_qty_unit;
                }
            });
			
			var stock_in_hand = formatPurDecimal(item.row.quantity);
			if(isNaN(stock_in_hand)){
				stock_in_hand = 0;
			}
			
            var row_no = (new Date).getTime();
            var newTr = $('<tr id="row_' + row_no + '" class="row_' + item_id + '" data-item-id="' + item_id + '"></tr>');
			tr_html = '<td class="text-right"><span class="text-center">#'+ no_ +'<input name="create_id[]" type="hidden" class="create_id" value="' + create_id + '"><input name="pur_id[]" type="hidden" class="pur_id" value="' + pur_id + '"><input name="create_order_id[]" type="hidden" class="create_order_id" value="' + create_order_id + '"></td>';
            tr_html += '<td><input name="product_id[]" type="hidden" class="rid" value="' + product_id + '"><input name="product[]" type="hidden" class="rcode" value="' + item_code + '"><input name="product_name[]" type="hidden" class="rname" value="' + item_name + '"><input name="type[]" type="hidden" class="rtype" value="' + type + '"><input type="hidden" name="tax_method[]" class="tax_method" value="' + item_tax_method + '" /><input name="product_option[]" type="hidden" class="roption" value="' + item_option + '"><input name="part_no[]" type="hidden" class="rpart_no" value="' + item_supplier_part_no + '"><input name="rsupplier_id[]" type="hidden" class="rsupplier_id" value="' + supplier_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' (' + item_code + ')'+(sel_opt != '' ? ' ('+sel_opt+')' : '')+' <span class="">'+ supplier_name +'</span><span class="label label-default">'+item_supplier_part_no+'</span></span> <i class="pull-right fa fa-edit tip edit" id="' + row_no + '" data-item="' + item_id + '" title="Edit" style="cursor:pointer;"></i></td>';
            if (site.settings.product_expiry == 1){
                tr_html += '<td><input class="form-control date rexpiry" name="expiry[]" type="text" value="' + item_expiry + '" data-id="' + row_no + '" data-item="' + item_id + '" id="expiry_' + row_no + '"></td>';
            }
			/* Price */

			if(owner || admin || purchase_price) {
				tr_html += '<td class="text-right"><input style="background:#C15858;color:#fff" type="text" class="form-control text-center rprice" value="' + price + '" name="price[]"></td>';
			}
			
            /* Unit Cost */
		
			/*if(owner || admin || purchase_cost) {
				if(localStorage.getItem('fDisable') == "yes"){
					tr_html += '<td class="text-right"><input class="form-control text-center sp" name="serial[]" type="hidden" value="' + serial_no + '"><input style="pointer-events: none;" class="form-control number_only text-center rcost" name="net_cost[]" type="text" id="cost_' + row_no + '" value="' + formatPurDecimal(net_unit_cost) + '"><input class="rucost" name="unit_cost[]" type="hidden" value="' + net_unit_cost + '"><input class="realucost" name="real_unit_cost[]" type="hidden" value="' + net_unit_cost + '"></td>';
				}else{
					tr_html += '<td class="text-right"><input class="form-control text-center sp" name="serial[]" type="hidden" value="' + serial_no + '"><input class="form-control number_only text-center rcost" name="net_cost[]" type="text" id="cost_' + row_no + '" value="' + formatPurDecimal(net_unit_cost) + '"><input class="rucost" name="unit_cost[]" type="hidden" value="' + net_unit_cost + '"><input class="realucost" name="real_unit_cost[]" type="hidden" value="' + net_unit_cost + '"></td>';
				}
				
			}*/

			if(owner || admin || purchase_cost) {
				tr_html += '<td class="text-right"><input class="form-control text-center sp" name="serial[]" type="hidden" value="' + serial_no + '"><input class="form-control number_only text-center rcost" name="net_cost[]" type="text" id="cost_' + row_no + '" value="' + formatPurDecimal(net_unit_cost) + '"><input class="rucost" name="unit_cost[]" type="hidden" value="' + net_unit_cost + '"><input class="realucost" name="real_unit_cost[]" type="hidden" value="' + net_unit_cost + '"><input class="realcost" type="hidden" value="' + item.row.real_cost + '"></td>';
			} else {
				tr_html += '<input class="rucost" name="unit_cost[]" type="hidden" value="' + net_unit_cost + '"><input class="realucost" name="real_unit_cost[]" type="hidden" value="' + net_unit_cost + '"><input class="realcost" type="hidden" value="' + item.row.real_cost + '">';
			}
			
			if(localStorage.getItem('fDisable') == "yes"){
				tr_html += '<td><input name="quantity_balance[]" type="hidden" class="rbqty" value="' + item_bqty + '"><input class="form-control text-center rquantity number_only" name="quantity[]" type="text" value="' + formatPurDecimal(item_qty) + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
			}else{
				tr_html += '<td><input name="quantity_balance[]" type="hidden" class="rbqty" value="' + item_bqty + '"><input class="form-control text-center rquantity number_only" name="quantity[]" type="text" value="' + formatPurDecimal(item_qty) + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
			}
			

			/* Stock Received */
			if (site.settings.shipping > 0 && poid > 0) {
                tr_html += '<td class="rec_con"><input name="ordered_quantity[]" type="hidden" class="oqty" value="' + item_qty + '"><input class="form-control text-center received" name="received[]" type="text" value="' + formatPurDecimal(qty_received) + '" data-id="' + row_no + '" data-item="' + item_id + '" id="received_' + row_no + '" onClick="this.select();"><input class="form-control text-center received_hidden" name="received_hidden[]" type="hidden" value="' + formatPurDecimal(qty_received) + '" data-id="' + row_no + '" data-item="' + item_id + '" id="received_hidden_' + row_no + '""></td>';
				item_qty = qty_received;
			}
			
			/* Stock In Hand */
			tr_html += '<td class="text-right"><input class="form-control input-sm text-right rstock" name="rstock[]" type="hidden" id="stock_' + stock_in_hand + '" value="' + stock_in_hand + '"><input class="rstock" name="rstock[]" type="hidden" value="' + stock_in_hand + '"><input class="rstock" name="rstock[]" type="hidden" value="' + stock_in_hand + '"><span class="text-right scost" id="sstock_' + row_no + '">' + stock_in_hand + '</span></td>';
			
            if (site.settings.product_discount == 1) {
                tr_html += '<td class="text-right"><input class="form-control input-sm rdiscount" name="product_discount[]" type="hidden" id="discount_' + row_no + '" value="' + item_ds + '"><input type="text" class="form-control text-center rdiscount text-danger" value="' + item_ds + '" id="sdiscount_' + row_no + '"></td>';
            }
			
            if (site.settings.tax1 == 1) {
                tr_html += '<td class="text-right"><input class="form-control input-sm text-right rproduct_tax" name="product_tax[]" type="hidden" id="product_tax_' + row_no + '" value="' + pr_tax.id + '"><span class="text-right sproduct_tax" id="sproduct_tax_' + row_no + '">' + (pr_tax_rate ? '(' + (pr_tax_rate == 0 ? formatPurDecimal(pr_tax_rate) : pr_tax_rate ) + ')' : '') + ' ' + formatMoney(pr_tax_val * (qty_received == item_qty? item_qty:qty_received)) + '</span></td>';
            }
            
			/* Sub Total */
			
			
			
			tr_html += '<td class="text-right"><span class="text-right ssubtotal" id="subtotal_' + row_no + '">' + formatMoney( (parseFloat(item_cost) + parseFloat(pr_tax_val)) * (qty_received == item_qty? item_qty:qty_received) ) + '</span></td>';
			
            tr_html += '<td class="text-center"><i class="fa fa-times tip podel" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
            newTr.html(tr_html);
            newTr.appendTo("#poTable");
			
			/* Total */
			total += (parseFloat(item_cost) + parseFloat(pr_tax_val)) * (qty_received == item_qty? item_qty:qty_received);

            count += parseFloat(item_qty);
			
            an++;
            if(!belong)
                //$('#row_' + row_no).addClass('danger');
			
			no_++;
        });
		if(owner || admin){
			var col = 4 ;
		}
		else{
			if(purchase_price == 1 || purchase_cost == 1){
				if(purchase_price == 1 && purchase_cost == 1){
					var col = 4;
					
				}
				else{
					var col = 3;
					
				}
			}else{
				var col = 2;
				
			}
		}	
		
        if (site.settings.product_expiry == 1) { col++; }
        var tfoot = '<tr id="tfoot" class="tfoot active"><th colspan="'+col+'">Total</th>';
        if (site.settings.shipping > 0 && poid > 0) {
			tfoot += '<th class="text-center"></th><th class="text-center">' + formatNumber(parseFloat(count) - 1) + '</th><th class="text-center"></th>';
		}else {
			tfoot += '<th class="text-center">' + formatNumber(parseFloat(count) - 1) + '</th><th class="text-center"></th>';
		}
        if (site.settings.product_discount == 1) {
            tfoot += '<th class="text-right">'+formatPurDecimal(product_discount)+'</th>';
        }
		
        if (site.settings.tax1 == 1) {
            tfoot += '<th class="text-right">'+formatPurDecimal(product_tax)+'</th>';
        }
        tfoot += '<th class="text-right">'+ formatPurDecimal(total)+'<input name="total_s" type="hidden" class="total_s" value="' + total + '"></th><th class="text-center"><i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i></th></tr>';
        $('#poTable tfoot').html(tfoot);
		
        // Order level discount calculations
        if (podiscount = localStorage.getItem('podiscount')) {
            var ds = podiscount;
            if (ds.indexOf("%") !== -1) {
                var pds = ds.split("%");
                if (!isNaN(pds[0])) {
                    order_discount = parseFloat(((total) * parseFloat(pds[0])) / 100);
                } else {
                    order_discount = parseFloat(((total) * parseFloat(ds)) / 100);
                }
            } else {
                order_discount = parseFloat(((total) * parseFloat(ds)) / 100);
            }
        }
		
        // Order level tax calculations
        if (site.settings.tax2 != 0) {
            if (potax2 = localStorage.getItem('potax2')) {
                $.each(tax_rates, function () {
                    if (this.id == potax2) {
                        if (this.type == 2) {
                            invoice_tax = parseFloat(this.rate);
                        }
                        if (this.type == 1) {
                            invoice_tax = parseFloat((((total - order_discount)+shipping) * this.rate) / 100);
                        }
                    }
                });
            }
        }
        total_discount = parseFloat(order_discount + product_discount);
        // Totals calculations after item addition
		//var gtotal = parseFloat(total + invoice_tax);
		var gtotal = parseFloat(((total - order_discount) + shipping) + formatPurDecimal(invoice_tax));
        $('#total').text(formatPurDecimal(total));
        $('#titems').text((an-1)+' ('+(parseFloat(count)-1)+')');
        $('#tds').text(formatPurDecimal(order_discount));
		$('#tship').text(formatMoney(shipping));
        if (site.settings.tax1) {
            $('#ttax1').text(formatPurDecimal(product_tax));
        }
        if (site.settings.tax2 != 0) {
            $('#ttax2').text(formatPurDecimal(invoice_tax));
        }
        $('#gtotal').text(formatPurDecimal(gtotal));
        //if (an > parseInt(site.settings.bc_fix) && parseInt(site.settings.bc_fix) > 0) {
			//This Link of code is animate the screen when too products select.
            //$("html, body").animate({scrollTop: $('#sticker').offset().top}, 500);
            //$(window).scrollTop($(window).scrollTop() + 1);
       // }
		//$('#postatus').trigger('change');
		
    }
}

function calDeposit(){
	$('#amount_1').val();
	var am = 0;
	var us_paid = $('#amount_1').val()-0;
	var amount_o = $("#amount_o").val()-0;
	
	var deposit_amount = parseFloat($(".deposit_amount").val()-0);
	var deposit_balance = 0;
	if(us_paid>amount_o){
		am = us_paid - amount_o;
		deposit_balance = (deposit_amount - am);
	}else{
		am = amount_o - us_paid;
		deposit_balance = (deposit_amount + am);
	}
	 
	$(".actual_total_balance").text(deposit_balance);
}
$(document).ready(function(){
	
	$('#slpayment_status').change(function (e) {
		var ps = $(this).val();
		localStorage.setItem('slpayment_status', ps);
		if (ps == 'partial' || ps == 'paid') {
			if(ps == 'paid') {
				$('#amount_1').val(formatDecimal(parseFloat(((total + formatDecimal(invoice_tax)) - order_discount) + shipping)));
				$('#total_balance_1').val(formatDecimal(parseFloat(((total + formatDecimal(invoice_tax)) - order_discount) + shipping)));
				//document.getElementById('amount_1').readOnly = true;
			}
			//if(ps == 'partial'){
			//	document.getElementById('amount_1').readOnly = false;
			//}
			$('#payments').slideDown();
			$(".hidd").show();
			$('#pcc_no_1').focus();
			calDeposit();
		} else {
			$('#amount_1').val('');
			$('#payments').slideUp();
		}
	});
});

$('.net_cost, .quantity').live('change',function(){
	var row = $(this).parent().parent();
	var net_price = $('.net_cost').val()-0;
	var quantity = row.find('.quantity').val()-0;
	var tax_per = row.find('.tax_percent').val();
	var tax_pay = 0;
	if(tax_per != '') {
		var rate = tax_per.split('%');
		tax_pay = ((net_price * quantity) * (rate[0]/100));
		row.find('.getTax').val(tax_pay);
		row.find('.sproduct_tax').text('('+tax_per+') '+formatPurDecimal(tax_pay));
	}
	var getTotal = formatPurDecimal(((parseFloat(net_price) * parseFloat(quantity))  + parseFloat(tax_pay)));
	row.find('.get_total').text(getTotal);
	
});


/* -----------------------------
 * Add Purchase Iten Function
 * @param {json} item
 * @returns {Boolean}
 ---------------------------- */
 function add_purchase_item(item) {
	
    if (count == 1) {
        poitems = {};
			
			if ($('#posupplier').val() && $('#powarehouse').val() ) {
				//$('#posupplier').select2("readonly", true);
			} else {
				
					bootbox.alert("Please select supplier and warehouse.");
					item = null;
					return;
				
			}
		
    }
    if (item == null) {
        return;
    }
    var item_id = site.settings.item_addition == 1 ? item.item_id : item.id;
    if (poitems[item_id]) {
        poitems[item_id].row.qty = parseFloat(poitems[item_id].row.qty) + 1;
    } else {
        poitems[item_id] = item;
    }
    
    localStorage.setItem('poitems', JSON.stringify(poitems));
    loadItems();
    return true;

}

if (typeof (Storage) === "undefined") {
    $(window).bind('beforeunload', function (e) {
        if (count > 1) {
            var message = "You will loss data!";
            return message;
        }
    });
}


