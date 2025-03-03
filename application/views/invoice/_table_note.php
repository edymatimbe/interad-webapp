

<?php foreach ($notes as $key => $note): ?>

	<?php $invoice = $this->core_model->get_by_id('invoice', array('id' => $note->invoice_id)) ?>
	<?php $customer = $this->core_model->get_by_id('customer', array('id' => $invoice->customer_id)) ?>

	<tr class="cursor-pointer tr text-nowrap">
		<td class="text-center " style="width: 5%"><?= $key + 1 ?></td>
		<td class="text-center " style="width: 5%"><?= $note->number ?></td>
		<td class="text-center " style="width: 5%"><?= $invoice->number.' / '.date_format(date_create($invoice->created_at), 'Y') ?></td>
		<td class="text-left" style="width: 10%">
			<?= $note->type == 'credit'?'Crédito':'Débito'?>
		</td>
		<td class="text-left" style="width: 25%">
			<?= $customer->name?>
		</td>
		<td class="text-right " style="width: 10%">
			<?= number_format($note->subtotal, 2) ?>
		</td>
		<td class="text-right " style="width: 10%">
			<?= number_format($note->total, 2) ?>
		</td>
		<td class="text-center " style="width: 10%">
			<?= date_format(date_create($note->created_at), 'd/m/Y') ?>
		</td>
		<td style="width: 10%" class="text-center text-nowrap">
			<button onclick="getNote(<?= $note->id ?>,'modal')" title="<?= $this->lang->line('show') ?>"
					class="btn btn-sm btn-outline-primary mx-2">
				<i class="feather icon-eye mr-2"></i><?= $this->lang->line('show') ?>
			</button>
		</td>
	</tr>
<?php endforeach; ?>
