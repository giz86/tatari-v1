<?php
// Transactions List View
$session = $this->session->userdata('username');
$currency = $this->Tat_model->currency_sign(0);
?>

<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $transaction = $this->Finance_model->get_transaction();?>

<?php
$balance2 = 0; $total_amount = 0; $transaction_credit = 0; $transaction_debit = 0;
?>

<?php $get_animate = $this->Tat_model->get_content_animate();?>

<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_acc_transactions');?> </h3>
  </div>
  <div class="box-body">
  <div class="box-datatable table-responsive">
    <table class="datatables-demo table table-striped table-bordered" id="tat_table">
      <input type="hidden" id="current_currency" value="<?php $curr = explode('0',$currency); echo $curr[0];?>" />
      <thead>
        <tr>
          <th><?php echo $this->lang->line('tat_e_details_date');?></th>
          <th><?php echo $this->lang->line('tat_acc_accounts');?></th>
          <th><?php echo $this->lang->line('tat_acc_dr_cr');?></th>
          <th><?php echo $this->lang->line('tat_type');?></th>
          <th><?php echo $this->lang->line('tat_amount');?></th>
          <th><?php echo $this->lang->line('tat_acc_ref_no');?></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>