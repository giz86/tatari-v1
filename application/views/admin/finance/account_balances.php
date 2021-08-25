<?php
// Account Balances - Finance View
$session = $this->session->userdata('username');
$currency = $this->Tat_model->currency_sign(0);
?>

<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $bankcash = $this->Finance_model->get_bankcash();?>

<?php
$account_balance = 0;;
foreach($bankcash->result() as $r) {
	$account_balance += $r->account_balance;
}
?>

<?php $get_animate = $this->Tat_model->get_content_animate();?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_acc_account_balances');?></h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="tat_table">
        <input type="hidden" id="current_currency" value="<?php $curr = explode('0',$currency); echo $curr[0];?>" />
        <thead>
          <tr>
            <th><?php echo $this->lang->line('tat_acc_account');?></th>
            <th><?php echo $this->lang->line('tat_acc_balance');?></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th colspan="1" style="text-align:right"><?php echo $this->lang->line('tat_acc_total');?>:</th>
            <th><?php echo $this->Tat_model->currency_sign($account_balance);?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
