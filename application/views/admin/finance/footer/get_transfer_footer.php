<?php $transfer = $this->Finance_model->get_transfer_search($from_date,$to_date);?>

<?php
$total_amount = 0;
foreach($transfer->result() as $r) {
	$total_amount += $r->amount;
}
?>

<tr>
  <th colspan="5">&nbsp;</th>
  <th><?php echo $this->lang->line('tat_acc_total');?>: <?php echo $this->Tat_model->currency_sign($total_amount);?></th>
</tr>
