<?php $deposit = $this->Finance_model->get_deposit_search($from_date,$to_date,$type_id);?>
<?php
$total_amount = 0;
foreach($deposit->result() as $r) {
	$total_amount += $r->amount;
}
?>

<tr>
  <th colspan="3">&nbsp;</th>
  <th style="float:right;"><?php echo $this->lang->line('tat_acc_total');?></th>
  <th><?php echo $this->Tat_model->currency_sign($total_amount);?></th>
</tr>
