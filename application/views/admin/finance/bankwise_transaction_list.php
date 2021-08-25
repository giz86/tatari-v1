<?php
/*
* Transactions Bank Wise - Finance View
*/
$session = $this->session->userdata('username');
$currency = $this->Tat_model->currency_sign(0);
?>

<?php $system = $this->Tat_model->read_setting_info(1);?>

<?php
$ac_id = $this->uri->segment(3);
$transactions = $this->Finance_model->get_bankwise_transactions($ac_id);
?>

<?php
$balance2 = 0; $total_amount = 0; $transaction_credit = 0; $transaction_debit = 0;
foreach($transactions->result() as $r) {
	if($r->transaction_debit == 0) {
		$balance2 = $balance2 - $r->transaction_credit;
	} else {
		$balance2 = $balance2 + $r->transaction_debit;
	}
	$total_amount += $r->total_amount;
	$transaction_credit += $r->transaction_credit;
	$transaction_debit += $r->transaction_debit;
}
?>

<?php $get_animate = $this->Tat_model->get_content_animate();?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_acc_transactions');?></h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="tat_table">
        <input type="hidden" id="current_currency" value="<?php $curr = explode('0',$currency); echo $curr[0];?>" />
        <thead>
          <tr>
            <th><?php echo $this->lang->line('tat_e_details_date');?></th>
            <th><?php echo $this->lang->line('tat_acc_accounts');?></th>
            <th><?php echo $this->lang->line('tat_type');?></th>
            <th><?php echo $this->lang->line('tat_amount');?></th>
            <th><?php echo $this->lang->line('tat_acc_credit');?></th>
            <th><?php echo $this->lang->line('tat_acc_debit');?></th>
            <th><?php echo $this->lang->line('tat_acc_balance');?></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th colspan="3">&nbsp;</th>
            <th><?php echo $this->lang->line('tat_total_amount');?>: <?php echo $this->Tat_model->currency_sign($total_amount);?></th>
            <th><?php echo $this->lang->line('tat_acc_credit');?>: <?php echo $this->Tat_model->currency_sign($transaction_credit);?></th>
            <th><?php echo $this->lang->line('tat_acc_debit');?>: <?php echo $this->Tat_model->currency_sign($transaction_debit);?></th>
            <th><?php echo $this->lang->line('tat_acc_balance');?>: <?php echo $this->Tat_model->currency_sign($balance2);?></th>
          </tr>
        </tfoot>
      </table>
      <input type="hidden" value="<?php echo $this->uri->segment(3);?>" id="current_segment" />
    </div>
  </div>
</div>
