<?php
	$v = "";
	if ($this->input->post('start_date')) {
		$v .= "&start_date=" . $this->input->post('start_date');
	}
	if ($this->input->post('end_date')) {
		$v .= "&end_date=" . $this->input->post('end_date');
	}
	if(isset($date)){
		$v .= "&d=" . $date;
	}

?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#form').hide();
        $('.toggle_down').click(function () {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function () {
            $("#form").slideUp();
            return false;
        });
        $("#product").autocomplete({
            source: '<?= site_url('reports/suggestions'); ?>',
            select: function (event, ui) {
                $('#product_id').val(ui.item.id);
                //$(this).val(ui.item.label);
            },
            minLength: 1,
            autoFocus: false,
            delay: 300,
        });
    });
</script>
<?php
	echo form_open('reports/paid_by_report', 'id="action-form"');
?>

<div class="box">
    <div class="box-header">
        <h2 class="blue">
			<i class="fa-fw fa fa-heart"></i><?=lang('paid_by_report'); ?>
			<?php 
				if ($this->input->post('start_date')) {
					echo "From " . $this->input->post('start_date') . " to " . $this->input->post('end_date');
				}
			?>
        </h2>
		<div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" class="toggle_up tip" title="<?= lang('hide_form') ?>">
                        <i class="icon fa fa-toggle-up"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="toggle_down tip" title="<?= lang('show_form') ?>">
                        <i class="icon fa fa-toggle-down"></i>
                    </a>
                </li>
            </ul>
        </div>
		<div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?=lang("actions")?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">
                        
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?=lang('export_to_excel')?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="pdf" data-action="export_pdf">
                                <i class="fa fa-file-pdf-o"></i> <?=lang('export_to_pdf')?>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>

    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>

	<div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?=lang('list_results');?></p>
				<div id="form">

                    <?php echo form_open("reports/paid_by_report"); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("start_date", "start_date"); ?>
                                <?php echo form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : ''), 'class="form-control datetime" id="start_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("end_date", "end_date"); ?>
                                <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : ''), 'class="form-control datetime" id="end_date"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div
                            class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="SLData" class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
							<tr>
								<th><?php echo $this->lang->line("paid_by"); ?></th>
								<th><?php echo $this->lang->line("amount"); ?></th>
								<th><?php echo $this->lang->line("actions"); ?></th>
							</tr>
                        </thead>
                        <tbody>
                        <?php
						
						$datt =$this->reports_model->getLastDate("payments","date");
						if ($this->input->POST('start_date')) {
							$start_date =  $this->erp->fsd($this->input->POST('start_date'));
						} else {
							$start_date = $datt;
						}
						if ($this->input->POST('end_date')) {
							$end_date =  $this->erp->fsd($this->input->POST('end_date'));
						} else {
							$end_date = $datt;
						}
						$paid_by = array(
							'cash' 		=> 'cash', 
							'CC'   		=> 'CC', 
							'gift_card' => 'gift_card', 
							'deposit'   => 'deposit', 
							'Cheque'	=> 'Cheque',
							'Voucher'	=> 'Voucher'
						);
						$total_amount = 0;
						foreach($paid_by as $paid){
							$qry = $this->db->query("SELECT SUM(COALESCE(erp_payments.amount, 0)) AS amount FROM erp_payments WHERE paid_by = '".$paid."' AND date >= '".$start_date." 00:00:00' AND date <= '".$end_date." 23:55:55' ;");
							
							foreach($qry->result() as $query){ 
								$total_amount += $query->amount;
							?>
								
								<tr>
									<td style="text-align:left;"><?= lang($paid); ?></td>
									<td class="text-center"><?= $this->erp->formatMoney($query->amount); ?></td>
									<td class="text-center">
										<?php echo form_open("reports/payments"); ?>
											<?php echo form_hidden('paid_by', (isset($_POST['paid_by']) ? $_POST['paid_by'] : $paid)); ?>
											<?php echo form_hidden('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : $this->erp->hrsd($start_date))); ?>
											<?php echo form_hidden('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : $this->erp->hrsd($end_date))); ?>
											<?php echo form_submit('submit_report', $this->lang->line("view_detail"), 'class="btn btn-link"'); ?>
										<?php echo form_close(); ?>
									</td>
								</tr>
						<?php 
							}
						}
						?>
                        </tbody>
                        <tfoot class="dtFilter">
							<tr class="text-center">
								<th style="text-align:center;"><?= lang('paid_by')?></th>
								<th class="text-center"><?= $this->erp->formatMoney($total_amount) ?></th>
								<th class="text-center"><?= lang('actions') ?></th>
							</tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('#excel').on('click', function (e) {
		e.preventDefault();
		if ($('.checkbox:checked').length <= 0) {
			window.location.href = "<?= site_url('reports/exportPaidByReport/0/xls/'.$start_date.'/'.$end_date) ?>";
			return false;
		}
	});
	$('#pdf').on('click', function (e) {
		e.preventDefault();
		if ($('.checkbox:checked').length <= 0) {
			window.location.href = "<?= site_url('reports/exportPaidByReport/pdf/0/'.$start_date.'/'.$end_date) ?>";
			return false;
		}
	});
</script>