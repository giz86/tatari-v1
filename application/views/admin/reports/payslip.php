<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>

<div class="row m-b-1 <?php echo $get_animate;?>">
  <div class="col-md-3">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_hr_report_filters');?> </h3>
      </div>
      
      <div class="box-body">
        <input type="hidden" id="user_id" value="0" />
        <?php $attributes = array('name' => 'payslip_report', 'id' => 'tat-form', 'autocomplete' => 'off', 'class' => 'm-b-1 add');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/reports/payslip_report', $attributes, $hidden);?>
        <?php if($user_info[0]->user_role_id==1){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>
              <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                <option value=""><?php echo $this->lang->line('tat_select_one');?></option>
                <?php foreach($all_companies as $company) {?>
                <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <?php } else {?>
        <?php $ecompany_id = $user_info[0]->company_id;?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>
              <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                <option value=""><?php echo $this->lang->line('tat_select_one');?></option>
                <?php foreach($all_companies as $company) {?>
                <?php if($ecompany_id == $company->company_id):?>
                <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
                <?php endif;?>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group" id="employee_ajax">
              <label for="employee"><?php echo $this->lang->line('dashboard_single_employee');?></label>
              <select name="employee_id" id="employee_id" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_choose_an_employee');?>">
                <option value=""></option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="month_year"><?php echo $this->lang->line('tat_select_month_year');?></label>
              <input class="form-control r_month_year" placeholder="<?php echo $this->lang->line('tat_select_month_year');?>" readonly name="month_year" id="month_year" type="text">
            </div>
          </div>
        </div>
        <div class="form-actions box-footer">
          <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('tat_save');?> </button>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>

  <div class="col-md-9 <?php echo $get_animate;?>">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_view');?> <?php echo $this->lang->line('tat_hr_reports_payslip');?> </h3>
      </div>
      <div class="box-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="tat_table">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('tat_employee_name');?></th>
                <th><?php echo $this->lang->line('tat_paid_amount');?></th>
                <th><?php echo $this->lang->line('tat_payment_month');?></th>
                <th><?php echo $this->lang->line('tat_payment_date');?></th>
                <th><?php echo $this->lang->line('tat_payslip');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.hide-calendar .ui-datepicker-calendar { display:none !important; }
.hide-calendar .ui-priority-secondary { display:none !important; }
</style>
