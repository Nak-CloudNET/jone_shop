<div class="modal-dialog" tabindex="1">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_category'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open_multipart("system_settings/add_category", $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>
			
			<!--<div class="form-group">
                <?php echo lang('main_brand', 'brand'); ?>
                <div class="controls"> <?php
                    $ct[""] = '';
                    foreach ($brand as $brands) {
                        $ct[$brands->id] = $brands->name;
                    }
                    echo form_dropdown('brand', $ct, (isset($_POST['brand']) ? $_POST['brand'] : $parent_id), 'class="form-control select" id="brand" required="required" placeholder="'.$this->lang->line("select") . " " . $this->lang->line("main_brand").'"');
                    ?> </div>
            </div>-->

            <div class="form-group">
                <?php echo lang('category_code', 'code'); ?>
                <div class="controls">
                    <?php echo form_input($code); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo lang('category_name', 'name'); ?>
                <div class="controls">
                    <?php echo form_input($name); ?>
                </div>
            </div>
			 <div class="form-group">
                <?php echo lang('cate_type', 'cate_type'); ?>
                <div class="controls">
                    <?php 
					$type = array(''=>'','food'=>'FOOD','drink'=>'DRINK');
					echo form_dropdown('cate_type', $type, '' ,'id="cate_type" class="form-control select" " style="width:100%;" '); 
					?>
                </div>
            </div>
            <div class="form-group">
                <?= lang("category_image", "image") ?>
                <input id="image" type="file" name="userfile" data-show-upload="false" data-show-preview="false"
                       class="form-control file">
            </div>
			<?php if($setting->acc_cate_separate == 1) { ?>
				<div class="form-group">
					<?= lang("account_sale","account_sale"); ?>
					<?php 
						$acc_section = array('' => '');
						foreach($chart_accounts as $section){
							$acc_section[$section->accountcode] = $section->accountcode.' | '.$section->accountname;
						}
						echo form_dropdown('account_sale', $acc_section, $category->ac_sale ,'id="account_sale" class="form-control" " style="width:100%;" ');
					?>
				</div>
				<div class="form-group">
					<?= lang("account_purchase","account_purchase"); ?>
					<?php 
						$acc_section = array('' => '');
						foreach($chart_accounts as $section){
							$acc_section[$section->accountcode] = $section->accountcode.' | '.$section->accountname;
						}
						echo form_dropdown('account_purchase', $acc_section,$category->ac_purchase,'id="account_purchase" class="form-control" " style="width:100%;" ');
					?>
				</div>
				<div class="form-group">
					<?= lang("account_stock","account_stock"); ?>
					<?php
						$acc_section = array('' => '');
						foreach($chart_accounts as $section){
							$acc_section[$section->accountcode] = $section->accountcode.' | '.$section->accountname;
						}
						echo form_dropdown('account_stock', $acc_section,$category->ac_stock ,'id="account_stock" class="form-control" " style="width:100%;" ');
					?>
				</div>
				<div class="form-group">
					<?= lang("account_stock_adjust","account_stock_adjust"); ?>
					<?php
						$acc_section = array('' => '');
						foreach($chart_accounts as $section){
							$acc_section[$section->accountcode] = $section->accountcode.' | '.$section->accountname;
						}
						echo form_dropdown('account_stock_adjust', $acc_section, $category->ac_stock_adj ,'id="account_stock_adjust" class="form-control" " style="width:100%;" ');
					?>
				</div>
				<div class="form-group">
					<?= lang("account_cost","account_cost"); ?>
					<?php
						$acc_section = array('' => '');
						foreach($chart_accounts as $section){
							$acc_section[$section->accountcode] = $section->accountcode.' | '.$section->accountname;
						}
						echo form_dropdown('account_cost', $acc_section, $category->ac_cost ,'id="account_cost" class="form-control" " style="width:100%;" ');
					?>
				</div>
				<div class="form-group">
					<?= lang("account_cost_variant","account_cost_variant"); ?>
					<?php 
						$acc_section = array('' => '');
						foreach($chart_accounts as $section){
							$acc_section[$section->accountcode] = $section->accountcode.' | '.$section->accountname;
						}
						echo form_dropdown('account_cost_variant', $acc_section,$category->ac_cost_variant,'id="account_cost_variant" class="form-control" " style="width:100%;" ');
					?>
				</div>
			<?php } ?>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_category', lang('add_category'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>