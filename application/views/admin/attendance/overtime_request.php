<?php
// Overtime Request Feature
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>

<div class="row m-b-1 <?php echo $get_animate;?>">
  <div class="col-md-12">
    <div class="box mb-4">
      <div class="box-header">
        <h3 class="box-title"><?php echo $this->lang->line('tat_overtime_request');?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-xs btn-primary" id="add_attendance_btn" data-toggle="modal" data-target=".add-modal-data"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('tat_add_new');?></button>
        </div>
      </div>

      <div class="box-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="tat_table">

            <thead>
              <tr>
                <th><?php echo $this->lang->line('tat_action');?></th>
                <th><?php echo $this->lang->line('tat_e_details_date');?></th>
                <th><?php echo $this->lang->line('tat_in_time');?></th>
                <th><?php echo $this->lang->line('tat_out_time');?></th>
                <th><?php echo $this->lang->line('tat_overtime_thours');?></th>
                <th><?php echo $this->lang->line('dashboard_tat_status');?></th>
              </tr>
            </thead>

          </table>
        </div>
      </div>

    </div>
  </div>
</div>
