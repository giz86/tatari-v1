<?php
// Invoice Payments List
$session = $this->session->userdata('client_username');
$currency = $this->Tat_model->currency_sign(0);
$system = $this->Tat_model->read_setting_info(1);?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>

<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('tat_acc_inv_payments');?> </h3>
  </div>
  <div class="box-body">
  <div class="box-datatable table-responsive">
    <table class="datatables-demo table table-striped table-bordered" id="tat_table">
      <input type="hidden" id="current_currency" value="" />
      <thead>
        <tr>
          <th><?php echo $this->lang->line('tat_invoice_no');?></th>
          <th><?php echo $this->lang->line('tat_issued_to');?></th>
          <th><?php echo $this->lang->line('tat_e_details_date');?></th>
          <th><?php echo $this->lang->line('tat_amount');?></th>
          <th><?php echo $this->lang->line('tat_payment_method');?></th>
          <th><?php echo $this->lang->line('tat_description');?></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>