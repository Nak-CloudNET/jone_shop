<?php if ($logo) { ?>
    <div class="text-center" style="margin-bottom:20px;">
             <p><b>LIST QUOTATION</b></p>
    </div>
<?php } ?>
<div class="well well-sm">
    <div class="row bold">
        <div class="col-xs-5">
        <p class="bold">
            <?= lang("ref"); ?>: <?= $inv->reference_no; ?><br>
            <?= lang("date"); ?>: <?= $this->erp->hrld($inv->date); ?><br>
            <?= lang("sale_status"); ?>:

            <?php if ($inv->status == 'approved') { ?>
                <span class="label label-success"><?= ucfirst($inv->status); ?></span>
            <?php } elseif ($inv->status == 'pending') { ?>
                <span class="label label-warning"><?= ucfirst($inv->status); ?></span>
            <?php } else { ?>
                <span class="label label-danger"><?= ucfirst($inv->status); ?></span>
            <?php } ?>
            <br>
        </p>
        </div>
        <div class="col-xs-6 text-right">
            <?php $br = $this->erp->save_barcode($inv->reference_no, 'code39', 70, false); ?>
            <img src="<?= base_url() ?>assets/uploads/barcode<?= $this->session->userdata('user_id') ?>.png"
                 alt="<?= $inv->reference_no ?>"/>
            <?php $this->erp->qrcode('link', urlencode(site_url('quotes/view/' . $inv->id)), 2); ?>
            <img src="<?= base_url() ?>assets/uploads/qrcode<?= $this->session->userdata('user_id') ?>.png"
                 alt="<?= $inv->reference_no ?>"/>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="row" style="margin-bottom:15px;">
    <div class="col-xs-6">
        <?php echo $this->lang->line("from"); ?>:
        <?php if ($Settings->system_management == 'project') { ?>
            <h2 style="margin-top:10px;"><?= $Settings->site_name; ?></h2>
        <?php } else { ?>
            <h2 style="margin-top:10px;"><?= $biller->company != '-' ? $biller->company : $biller->name; ?></h2>
        <?php } ?>
        <?= $biller->company ? "" : "Attn: " . $biller->name ?>

        <?php
        echo $biller->address . "<br>" . $biller->city . " " . $biller->postal_code . " " . $biller->state . "<br>" . $biller->country;

        echo "<p>";

        if ($biller->cf1 = "-" && $biller->cf1 = "") {
            echo "<br>" . lang("bcf1") . ": " . $biller->cf1;
        }
        if ($biller->cf2 = "-" && $biller->cf2 = "") {
            echo "<br>" . lang("bcf2") . ": " . $biller->cf2;
        }
        if ($biller->cf3 = "-" && $biller->cf3 = "") {
            echo "<br>" . lang("bcf3") . ": " . $biller->cf3;
        }
        if ($biller->cf4 = "-" && $biller->cf4 = "") {
            echo "<br>" . lang("bcf4") . ": " . $biller->cf4;
        }
        if ($biller->cf5 = "-" && $biller->cf5 = "") {
            echo "<br>" . lang("bcf5") . ": " . $biller->cf5;
        }
        if ($biller->cf6 = "-" && $biller->cf6 = "") {
            echo "<br>" . lang("bcf6") . ": " . $biller->cf6;
        }

        echo "</p>";
        echo lang("tel") . ": " . $biller->phone . "<br>" . lang("email") . ": " . $biller->email;
        ?>
    </div>
    <div class="col-xs-5">
        <?php echo $this->lang->line("to"); ?>:<br/>
        <h2 style="margin-top:10px;"><?= $customer->company ? $customer->company : $customer->name; ?></h2>
        <?= $customer->company ? "" : "Attn: " . $customer->name ?>

        <?php
        echo $customer->address . "<br>" . $customer->city . " " . $customer->postal_code . " " . $customer->state . "<br>" . $customer->country;

        echo "<p>";

        if ($customer->cf1 != "-" && $customer->cf1 != "") {
            echo "<br>" . lang("ccf1") . ": " . $customer->cf1;
        }
        if ($customer->cf2 != "-" && $customer->cf2 != "") {
            echo "<br>" . lang("ccf2") . ": " . $customer->cf2;
        }
        if ($customer->cf3 != "-" && $customer->cf3 != "") {
            echo "<br>" . lang("ccf3") . ": " . $customer->cf3;
        }
        if ($customer->cf4 != "-" && $customer->cf4 != "") {
            echo "<br>" . lang("ccf4") . ": " . $customer->cf4;
        }
        if ($customer->cf5 != "-" && $customer->cf5 != "") {
            echo "<br>" . lang("ccf5") . ": " . $customer->cf5;
        }
        if ($customer->cf6 != "-" && $customer->cf6 != "") {
            echo "<br>" . lang("ccf6") . ": " . $customer->cf6;
        }

        echo "</p>";
        echo lang("tel") . ": " . $customer->phone . "<br>" . lang("email") . ": " . $customer->email;
        ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped print-table order-table">

        <thead>

        <tr>
            <th><?= lang("no"); ?></th>
            <th><?= lang("image"); ?></th>
            <th><?= lang("description"); ?></th>
            <th><?= lang("quantity"); ?></th>
            <th><?= lang("qoh"); ?></th>
            <th><?= lang("unit_price"); ?></th>
            <?php
            if ($Settings->tax1) {
                echo '<th>' . lang("tax") . '</th>';
            }
            if ($Settings->product_discount && $inv->product_discount != 0) {
                echo '<th>' . lang("discount") . '</th>';
            }
            ?>
            <th><?= lang("subtotal"); ?></th>
        </tr>

        </thead>

        <tbody>
        
        <?php $r = 1;
        $tax_summary = array();
        foreach ($rows as $row):
        ?>
            <tr>
                <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?= '<img class="img-rounded img-thumbnail" style="width:60px;height:60px;" src="assets/uploads/thumbs/'.$row->image.'">' ?></td>
                <td style="vertical-align:middle;">
                    <?= $row->product_name . " (" . $row->product_code . ")" . ($row->variant ? ' (' . $row->variant . ')' : ''); ?>
                    <?= $row->details ? '<br>' . $row->details : ''; ?>
                </td>
                <td style="width: 80px; text-align:center; vertical-align:middle;"><?= $this->erp->formatQuantity($row->quantity); ?></td>
                
                <td style="width: 80px; text-align:center; vertical-align:middle;"><?= $this->erp->formatQuantity($row->qoh); ?></td>
                
                <td style="text-align:right; width:100px;"><?= $this->erp->formatMoney($row->unit_price); ?></td>
                <?php
                if ($Settings->tax1) {
                    echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->item_tax != 0 && $row->tax_code ? '<small>('.$row->tax_code.')</small>' : '') . ' ' . $this->erp->formatMoney($row->item_tax) . '</td>';
                }
                if ($Settings->product_discount && $inv->product_discount != 0) {
                    echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small> ' : '') . $this->erp->formatMoney($row->item_discount) . '</td>';
                }
                ?>
                <td style="text-align:right; width:120px;"><?= $this->erp->formatMoney($row->subtotal); ?></td>
            </tr>
            <?php
            $r++;
        endforeach;
        ?>
        </tbody>
        <tfoot>
        <?php
        $col = 6;
        if ($Settings->product_discount && $inv->product_discount != 0) {
            $col++;
        }
        if ($Settings->tax1) {
            $col++;
        }
        if ($Settings->product_discount && $inv->product_discount != 0 && $Settings->tax1) {
            $tcol = $col - 2;
        } elseif ($Settings->product_discount && $inv->product_discount != 0) {
            $tcol = $col - 1;
        } elseif ($Settings->tax1) {
            $tcol = $col - 1;
        } else {
            $tcol = $col;
        }
        ?>
        <?php if ($inv->grand_total != $inv->total) { ?>
            <tr>
                <td colspan="<?= $tcol; ?>"
                    style="text-align:right; padding-right:10px;"><?= lang("total"); ?>
                    (<?= $default_currency->code; ?>)
                </td>
                <?php
                if ($Settings->tax1) {
                    echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_tax) . '</td>';
                }
                if ($Settings->product_discount && $inv->product_discount != 0) {
                    echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_discount) . '</td>';
                }
                ?>
                <td style="text-align:right; padding-right:10px;"><?= $this->erp->formatMoney($inv->total); ?></td>
            </tr>
        <?php } ?>

        <?php if ($inv->order_discount != 0) {
            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("order_discount") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->erp->formatMoney($inv->order_discount) . '</td></tr>';
        }
        ?>
        <?php if ($inv->shipping != 0) {
            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("shipping") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->erp->formatMoney($inv->shipping) . '</td></tr>';
        }
        ?>
        <?php if ($Settings->tax2 && $inv->order_tax != 0) {
            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;">' . lang("order_tax") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->erp->formatMoney($inv->order_tax) . '</td></tr>';
        }
        ?>
        
        <tr>
            <td colspan="<?= $col; ?>"
                style="text-align:right; font-weight:bold;"><?= lang("total_amount"); ?>
                (<?= $default_currency->code; ?>)
            </td>
            <td style="text-align:right; padding-right:10px; font-weight:bold;"><?= $this->erp->formatMoney($inv->grand_total - $deposit->deposit_amount); ?></td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php
            if ($inv->note || $inv->note != "") { ?>
                <div class="well well-sm">
                    <p class="bold"><?= lang("note"); ?>:</p>
                    <div><?= $this->erp->decode_html($inv->note); ?></div>
                </div>
            <?php } ?>
    </div>

    <div class="col-xs-5 pull-right">
        <div class="well well-sm">
            <p>
                <?= lang("created_by"); ?>: <?= $created_by->first_name . ' ' . $created_by->last_name; ?> <br>
                <?= lang("date"); ?>: <?= $this->erp->hrld($inv->date); ?>
            </p>
            <?php if ($inv->updated_by) { ?>
            <p>
                <?= lang("updated_by"); ?>: <?= $updated_by->first_name . ' ' . $updated_by->last_name;; ?><br>
                <?= lang("update_at"); ?>: <?= $this->erp->hrld($inv->updated_at); ?>
            </p>
            <?php } ?>
        </div>
    </div>
</div>
<?php if (!$Supplier || !$Customer) { ?>
    <div class="buttons">
        <?php if ($inv->attachment) { ?>
            <div class="btn-group">
                <a href="<?= site_url('welcome/download/' . $inv->attachment) ?>" class="tip btn btn-primary" title="<?= lang('attachment') ?>">
                    <i class="fa fa-chain"></i>
                    <span class="hidden-sm hidden-xs"><?= lang('attachment') ?></span>
                </a>
            </div>
        <?php } ?>        
    </div>
<?php } ?>