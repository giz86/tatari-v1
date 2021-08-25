<?php
// Accounts - Finance View
$session = $this->session->userdata('username');
?>

<?php $get_animate = $this->Tat_model->get_content_animate();?>
<div class="row m-b-1 <?php echo $get_animate;?>">
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>

<?php if(in_array('4',$role_resources_ids)) {?>
  <div class="col-md-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_add_new');?> <?php echo $this->lang->line('tat_acc_account');?> </h3>
      </div>
      <div class="box-body">
        <?php $attributes = array('name' => 'add_bankcash', 'id' => 'tat-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/finance/add_bankcash', $attributes, $hidden);?>
        <div class="form-group">
          <label for="account_name"><?php echo $this->lang->line('tat_acc_account_name');?></label>
          <input type="text" class="form-control" name="account_name" placeholder="<?php echo $this->lang->line('tat_acc_account_name');?>">
        </div>
        <div class="form-group">
          <label for="account_balance"><?php echo $this->lang->line('tat_acc_initial_balance');?></label>
          <input type="text" class="form-control" name="account_balance" placeholder="<?php echo $this->lang->line('tat_acc_initial_balance');?>">
        </div>
        <div class="form-group">
          <label for="account_number"><?php echo $this->lang->line('tat_e_details_acc_number');?></label>
          <input type="text" class="form-control" name="account_number" placeholder="<?php echo $this->lang->line('tat_e_details_acc_number');?>">
        </div>
        <div class="form-group">
          <label for="branch_code"><?php echo $this->lang->line('tat_acc_branch_code');?></label>
          <input type="text" class="form-control" name="branch_code" placeholder="<?php echo $this->lang->line('tat_acc_branch_code');?>">
        </div>
        <div class="form-group">
          <label for="description"><?php echo $this->lang->line('tat_e_details_bank_branch');?></label>
          <textarea class="form-control" name="bank_branch" placeholder="<?php echo $this->lang->line('tat_e_details_bank_branch');?>" rows="5"></textarea>
        </div>
        <div class="form-actions box-footer">
          <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('tat_save');?> </button>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>

  <?php $colmdval = 'col-md-8';?>
  <?php } else {?>
  <?php $colmdval = 'col-md-12';?>
  <?php } ?>
  
  <div class="<?php echo $colmdval;?>">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_acc_accounts');?> </h3>
      </div>
      <div class="box-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="tat_table">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('tat_action');?></th>
                <th><?php echo $this->lang->line('tat_acc_accounts');?></th>
                <th><?php echo $this->lang->line('tat_acc_account_no');?></th>
                <th><?php echo $this->lang->line('tat_acc_branch_code');?></th>
                <th><?php echo $this->lang->line('tat_acc_balance');?></th>
                <th><?php echo $this->lang->line('tat_e_details_bank_branch');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
