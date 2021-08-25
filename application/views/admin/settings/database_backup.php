<?php
// Database Backup Log view
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>

<div class="row  <?php echo $get_animate;?>" style="margin-bottom:10px;">
  <div class="col-md-3">
    <?php $attributes = array('name' => 'db_backup', 'id' => 'db_backup', 'autocomplete' => 'off');?>
    <?php $hidden = array('user_id' => $session['user_id']);?>
    <?php echo form_open('admin/settings/create_database_backup', $attributes, $hidden);?>
    <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('tat_create_backup');?></button>
    <?php echo form_close(); ?> </div>
</div>

<div class="box  <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $this->lang->line('tat_add_new');?> <?php echo $this->lang->line('tat_backup_log');?></h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="tat_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('tat_action');?></th>
            <th><?php echo $this->lang->line('tat_database_file');?></th>
            <th><?php echo $this->lang->line('tat_e_details_date');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
