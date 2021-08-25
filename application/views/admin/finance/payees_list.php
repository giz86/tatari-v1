<?php
// Payees List View 
$session = $this->session->userdata('username');
?>

<?php $get_animate = $this->Tat_model->get_content_animate();?>

<div class="row m-b-1 <?php echo $get_animate;?>">
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<?php if(in_array('364',$role_resources_ids)) {?>
  <div class="col-md-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_add_new');?> <?php echo $this->lang->line('tat_acc_payee');?> </h3>
      </div>
      <div class="box-body">
        <?php $attributes = array('name' => 'add_payee', 'id' => 'tat-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/finance/add_payee', $attributes, $hidden);?>
        <div class="form-group">
          <label for="account_name"><?php echo $this->lang->line('tat_acc_payee');?></label>
          <input type="text" class="form-control" name="payee_name" placeholder="<?php echo $this->lang->line('tat_acc_payee_name');?>">
        </div>
        <div class="form-group">
          <label for="account_balance"><?php echo $this->lang->line('tat_contact_number');?></label>
          <input type="text" class="form-control" name="contact_number" placeholder="<?php echo $this->lang->line('tat_contact_number');?>">
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
        <h3 class="box-title"> <?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_acc_payees');?> </h3>
      </div>
      <div class="box-body">
      <div class="box-datatable table-responsive">
        <table class="datatables-demo table table-striped table-bordered" id="tat_table">
          <thead>
            <tr>
              <th><?php echo $this->lang->line('tat_action');?></th>
              <th><?php echo $this->lang->line('tat_acc_payee');?></th>
              <th><?php echo $this->lang->line('tat_contact_number');?></th>
              <th><?php echo $this->lang->line('tat_acc_created_at');?></th>
            </tr>
          </thead>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
