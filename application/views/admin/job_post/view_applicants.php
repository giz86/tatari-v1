
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>

<input type="hidden" id="job_id" value="<?php echo $this->uri->segment(4);?>" />
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_job_applicants_title');?> </h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="tat_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('tat_action');?></th>
            <th><?php echo $this->lang->line('tat_candidate_name');?></th>
            <th><?php echo $this->lang->line('dashboard_email');?></th>
            <th><?php echo $this->lang->line('dashboard_tat_status');?></th>
            <th><?php echo $this->lang->line('tat_jobs_cover_letter');?></th>
            <th><?php echo $this->lang->line('tat_apply_date');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
