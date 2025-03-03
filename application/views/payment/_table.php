<?php $counter = 0;
$total = 0;
foreach ($payments as $payment): ?>
	<tr class="">
		<td class="text-center" style="width: 5%"><?= $counter + 1 ?></td>
		<td class="text-center" style="width: 10%"><?= $payment->receipt ?></td>
		<td style="width: 25%"><?= $payment->customer?></td>
		<td style="width: 20%">
				<?= $payment->pay_method_name ?>
		</td>
		<td class="text-right" style="width: 15%">
			<?= number_format($payment->amount, 2) . ' MT' ?>
		</td>
		<td class="text-center" style="width: 15%">
			<?= date_format(date_create($payment->created_at), 'd/m/Y H:i') ?>
		</td>
		<td class="text-center m-0 px-3 text-nowrap" style="width: 10%">
			
			<button onclick="get_payment_receipt(<?= $payment->id ?>,'modal')" title="<?= $this->lang->line('receipt') ?>"
					class="btn btn-sm btn-outline-secondary">
				<i class="fa fa-file-pdf-o text-danger">&nbsp;</i><?= $this->lang->line('receipt') ?>
			</button>
		</td>
	</tr>
	<?php $counter += 1; ?>
<?php endforeach; ?>
