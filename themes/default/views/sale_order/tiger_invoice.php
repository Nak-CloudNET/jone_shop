<?php //$this->erp->print_arrays($quote_items);?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->lang->line("tiger_invoice") . " " . $inv->do_reference_no; ?></title>
    <link href="<?php echo $assets ?>styles/theme.css" rel="stylesheet">
    <style type="text/css">
        body:before, body:after {
            display: none !important;
        }
		@page { size: A5 landscape }
		h4{
			font-family: Khmer OS Muol Light !important;
		}
		p{
			font-size: 12px;
		}
    </style>
</head>

<body class="A5 landscape">
<div class="print_rec" id="wrap" style="width: 90%; margin: 0 auto;">
    <div class="row">
        <div class="col-xs-12">
				<div class="row col-xs-12">
					<div class="col-xs-3" style="margin-bottom:20px;margin-top:20px;">
						<?php if ($logo) { ?>
							<img src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>"
								 alt="">
						<?php } ?>
					</div>
					<div class="col-xs-6" style="margin-left:0px;margin-top:11px;">
						<h4>
							<?php if($biller->company_kh){
								echo $biller->company_kh."<br>";
							} 
								echo $biller->company; ?>
						</h4>
						<?php
							echo "<p>";
								if($biller->address){ echo lang('address')." : ".$biller->address;} 
								echo '<br>';
								if($biller->phone){ echo lang("tel") . " : ".$biller->phone;}
								// if($biller->email){echo "&nbsp &nbsp".lang("email")." : ". $biller->email;}
							echo "</p>";
						?> 
					</div>
					
					<div class="col-xs-3">
					</div>
				</div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
				<div  class="col-xs-9"></div>
                <div class="col-xs-3"  style="font-size:14px">
                    <table>
                        <tr>
                            <td>
                                <p><?= lang("date_kh");?>៖</p>
                            </td>
                            <td>
                               <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$inv->date."</b>"; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><?= lang("do_no"); ?></p>
                            </td>
                            <td>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$inv->do_reference_no ."</b>";?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="-table-responsive">
                <table class="table table-bordered table-hover" style="width: 100%;">
                    <thead  style="font-size: 13px;">
                    </thead>
                    <tbody style="font-size: 13px;">
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('customer_name_kh')."</br>"; ?>
									<?php echo lang('customers_name')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
									<?=  "<b>".$row->customer_name."</b>"; ?>
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('number_truck_kh')."</br>"; ?>
									<?php echo lang('number_truck')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;">
									<?php echo $totaldq->num_truck; ?>
								</td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('place_delivery_kh')."</br>"; ?>
									<?php echo lang('place_delivery')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
									<?php echo $customer->address; ?>
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('delivery_quantity_kh')."</br>"; ?>
									<?php echo lang('delivery_quantity')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;">
									<?php echo $this->erp->formatQuantity($dq->quantity_received); ?>
								</td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('departure_time_kh')."</br>"; ?>
									<?php echo lang('departure_time')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
									<?php  echo $time; ?>
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('total_concrete_quantity_kh')."</br>"; ?>
									<?php echo lang('total_concrete_quantity')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;">
									<?php echo$this->erp->formatQuantity( $row->qty); ?>
								</td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('arrival_time_kh')."</br>"; ?>
									<?php echo lang('arrival_time')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
									<?php echo "............"; ?>
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('compressive_strength_kh')."</br>"; ?>
									<?php echo lang('compressive_strength')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;">
									<?php echo $inv_items->description; ?>
								</td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('finished_casting_time_kh')."</br>"; ?>
									<?php echo lang('finished_casting_time')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
									<?php echo "............"; ?>
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('slump_kh')."</br>"; ?>
									<?php echo lang('slump')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;"></td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('customer_phone_kh')."</br>"; ?>
									<?php echo lang('customers_phone')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('truck_plate_number_kh')."</br>"; ?>
									<?php echo lang('truck_plate_number')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;"></td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('add_up_expenses_kh')."</br>"; ?>
									<?php echo lang('add_up_expenses')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
								</td>
								<td style="vertical-align:middle;width:15%">
									<?php echo "<p>".lang('driver_name_kh')."</br>"; ?>
									<?php echo lang('driver_name')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:15%;text-align:center;">
									<?php echo $inv_items->name; ?>
								</td>
							</tr>
							<tr>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('customer_sign_cmt_kh')."</br>"; ?>
									<?php echo lang('customer_sign_cmt')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;" >
								</td>
								<td style="width:17%; vertical-align:middle;">
									<?php echo "<p>".lang('deliverer_kh')."</br>"; ?>
									<?php echo lang('deliverer')."</p>"; ?>
								</td>
								<td style="vertical-align:middle; width:25%;text-align:center;" >
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<div >
									<?php echo lang('warning_kh').":"."</br>";?>
									<?php echo lang('warning')." : ".strip_tags($inv->note); ?>
									</div>
								</td>
							</tr>
					</tbody>
                </table>
            </div>
            <br>

        </div>
    </div>
</div>
<div id="mydiv" style="display:none;">

<br/><br/>
<div id="wrap" style="width: 90%; margin:0px auto;">
<div class="col-xs-10" style="margin-bottom:20px;">
	<button type="button" class="btn btn-primary btn-default no-print pull-left" onclick="window.print();">
		<i class="fa fa-print"></i> <?= lang('print'); ?>
	</button>&nbsp;&nbsp;
</div>
</div> 

<script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('click', '#b-add-quote' ,function(event){
    event.preventDefault();
    localStorage.removeItem('slitems');
    window.location.href = "<?= site_url('quotes/add'); ?>";
  });
});

</script>
</body>
</html>
