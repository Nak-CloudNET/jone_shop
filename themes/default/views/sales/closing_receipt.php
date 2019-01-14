<?php
// $this->erp->print_arrays($alert_id);
$v = "";
/* if($this->input->post('name')){
  $v .= "&product=".$this->input->post('product');
  } */
if ($this->input->post('start_date')) {
    $v .= "&start_date=" . $this->input->post('start_date');
}
if ($this->input->post('end_date')) {
    $v .= "&end_date=" . $this->input->post('end_date');
}


if(isset($alert_id)){
    $v .= "&a=" . $alert_id;
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

    });
</script>



<div class="box">
    <div class="box-header">
        <!-- <h2 class="blue"><i
                class="fa-fw fa fa-heart"></i><?=lang('sales') . ' ('. ($warehouse_id? $warehouse->name : lang('Closing Receipt')) .')';?>
        </h2> -->
        <?php if ($warehouse_id) { ?>
            <h2 class="blue">
                <i class="fa-fw fa fa-barcode"></i>
                <?= lang('sales'); ?>
                (
                <?php
                if (count($warehouse) > 1) {
                    echo lang('Closing Receipt');
                } else {
                    if (is_array($warehouse)) {
                        foreach ($warehouse as $ware) {
                            echo $ware->name;
                        }
                    }
                    echo $warehouse->name;
                }
                ?>
                )
            </h2>
        <?php } else { ?>
            <h2 class="blue">
                <i class="fa-fw fa fa-barcode"></i>
                <?= lang('sales') . ' (' . lang('Closing Receipt') . ')'; ?>
            </h2>
        <?php } ?>

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
                <?php if ($Owner || $Admin || $GP['sales-payments'] || $GP['sales-add'] || $GP['sales-export'] || $GP['sales-import'] || $GP['sales-combine_pdf']) { ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?=lang("actions")?>"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">

                            <?php if ($Owner || $Admin || $GP['sales-payments']) { ?>
                                <li>
                                    <a data-target="#myModal" data-toggle="modal" href="javascript:void(0)" id="combine_pay" data-action="combine_pay">
                                        <i class="fa fa-money"></i> <?=lang('combine_to_pay')?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($Owner || $Admin || $GP['sales-add']) { ?>
                                <li>
                                    <a href="<?=site_url('sales/add')?>">
                                        <i class="fa fa-plus-circle"></i> <?=lang('add_sale')?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($Owner || $Admin || $GP['sales-export']) { ?>
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

                            <?php } ?>

                            <?php if($Owner || $Admin || $GP['sales-import']) { ?>
                                <li>
                                    <a href="<?= site_url('sales/sale_by_csv'); ?>">
                                        <i class="fa fa-plus-circle"></i>
                                        <span class="text"> <?= lang('add_sale_by_csv'); ?></span>
                                    </a>
                                </li>
                            <?php }?>
                            <?php if($Owner || $Admin || $GP['sales-combine_pdf']) { ?>
                                <li>
                                    <a href="#" id="combine" data-action="combine">
                                        <i class="fa fa-file-pdf-o"></i> <?=lang('combine_to_pdf')?>
                                    </a>
                                </li>
                            <?php }?>

                        </ul>
                    </li>
                <?php } ?>
                <?php if (!empty($warehouses)) {
                    ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?=lang("warehouses")?>"></i></a>
                        <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?=site_url('sales')?>"><i class="fa fa-building-o"></i> <?=lang('all_warehouses')?></a></li>
                            <li class="divider"></li>
                            <?php
                            foreach ($warehouses as $warehouse) {
                                echo '<li><a href="' . site_url('sales/' . $warehouse->id) . '"><i class="fa fa-building"></i>' . $warehouse->name . '</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
    <?php //if ($Owner) {?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?=form_submit('performAction', 'performAction', 'id="action-form-submit"')?>
    </div>
    <?= form_close()?>
    <?php //}
    ?>
    <div class="box-content" style="overflow-x:scroll; width: 100%;">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?=lang('list_results');?></p>
                <div id="form">

                    <?php echo form_open("sales/closing_receipt"); ?>
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
                        <div class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="text-align: center">
                                <?=lang('Closing sale report');?></p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="text-align: center">
                                <?=lang('Shift date : ');?><?= $start_date ?></p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="text-align: center">
                                <?=lang('Shift1');?></p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="text-align: center">
                                <?= $end_date ?></p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="text-align: center">
                                <?=lang('Jones The Grocer Aeon Sen Sok City');?></p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <tr>
                                <td style="border-right: 1px solid white !important;border-left: 1px solid black;border-top: 1px solid black">Currenct</td>
                                <td style="border-right: 1px solid white !important;border-top: 1px solid black"></td>
                                <td style="border-right: 1px solid white !important;border-top: 1px solid black">Checks</td>
                                <td style="border-right: 1px solid white !important;border-top: 1px solid black">Guests</td>
                                <td style="border-right: 1px solid black;border-top: 1px solid black">Amount</td>

                            </tr>

                            <tbody>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black">USD</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;">104</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;">110</td>
                                <td style="border-bottom: 1px solid white !important;border-right: 1px solid black"><?= $sale->amount;?></td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black">Riel</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;">35</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;">38</td>
                                <td style="border-bottom: 1px solid black !important;border-right: 1px solid black">75.69</td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black"></td>
                                <td style="text-align: right; border-right: 1px solid white !important;border-bottom: 1px solid white !important;">Cash</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;"></td>
                                <td style="border-bottom: 1px solid black !important;border-right: 1px solid black">1260.02</td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black">VISA</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;">4</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;">4</td>
                                <td style="border-bottom: 1px solid black !important;border-right: 1px solid black">26.98</td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black"></td>
                                <td style="text-align: right;border-right: 1px solid white !important;border-bottom: 1px solid white !important;">Credit card</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;"></td>
                                <td style="border-bottom: 1px solid black !important;border-right: 1px solid black">26.98</td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black">Total Checks  :</td>
                                <td style="text-align: left;border-right: 1px solid white !important;border-bottom: 1px solid white !important;">131</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;"></td>
                                <td style="border-bottom: 1px solid white !important;border-right: 1px solid black"></td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;border-left: 1px solid black">Total Guests  :</td>
                                <td style="text-align: left;border-right: 1px solid white !important;border-bottom: 1px solid white !important;">139</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid white !important;"></td>
                                <td style="border-bottom: 1px solid white !important;border-right: 1px solid black"></td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;border-left: 1px solid black">Total Amount  :</td>
                                <td style="text-align: left;border-right: 1px solid white !important;border-bottom: 1px solid black !important;">1287</td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;"></td>
                                <td style="border-right: 1px solid white !important;border-bottom: 1px solid black !important;"></td>
                                <td style="border-bottom: 1px solid black !important;border-right: 1px solid black"></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black">Discount</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;">Checks</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid black;">Amount</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">10% Discount</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">1</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-10</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">15% Discount</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">1</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-5</td>

                            </tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">25% Discount</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">1</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-15</td>
                            <tr>


                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;border-top: 1px solid white;">50% Discount</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;border-top: 1px solid white;"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;border-top: 1px solid white;text-align: right">1</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;border-top: 1px solid white;"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid white;text-align: right">-23</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">Coupon</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">1</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-3</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">Voucher</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">1</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-25</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black">Complement</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black;text-align: right">1</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black;"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-32</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">Total</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">7</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">-113</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black">Categories</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black">Q-ty</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black">Amount</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">HOT DRINKS</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">53</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">100</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">COLD DRINKS</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">51</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">100</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">PASTRY</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">29</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">100</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">BREAKFAST</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">20</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">400</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">LUNCH</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">20</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">400</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black">RETAIL</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black;text-align: right">20</td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid white;border-right: 1px solid black;border-left: 1px solid black;text-align: right">400</td>

                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black">WINE & BEER</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black;text-align: right">20</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;text-align: right">400</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black;text-align: right">Total</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black;text-align: right">212</td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid white;border-left: 1px solid black"></td>
                                <td style="border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;text-align: right">1400</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
