<div class="d-flex flex-column justify-content-between h-100">
	<div class="table-responsive" id="div-table-sm" style="overflow-x: auto; overflow-y: auto">
		<table class="table table-border-top-0">
			<thead>
			<tr>
				<th class="text-capitalize"><?= $this->lang->line(is_service()?'service':'product') ?></th>
				<th class="text-right"><?= $this->lang->line('price') ?></th>
				<th class="text-right"><?= $this->lang->line('quantity_sm') ?></th>
				<th class="text-right">Subtotal</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $item): ?>
				<?php $price = $item->other_price == 0 ? $item->price : $item->other_price ?>
				<tr>
					<td><?= $item->product ?></td>
					<td class="text-right"><?= $this->cart->format_number($price) ?></td>
					<td class="text-right"><?= $item->quantity ?></td>
					<td class="text-right"><?= $this->cart->format_number($price * $item->quantity) ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<ul class="list-group list-group-flush mb-lg-4 f-s-15 px-2">
		<?php if ($invoice->discount > 0): ?>
			<li class="list-group-item px-0">
				<span class="f-w-600 text-capitalize"><?= $this->lang->line('discount') ?></span>
				<span
					class="float-right cart-discount"><?= number_format($invoice->discount, 2) ?> MT</span>
			</li>
		<?php endif ?>
		<li class="list-group-item px-0">
			<span class="f-w-600">Subtotal</span><span
				class="float-right cart-subtotal"><?= number_format($invoice->subtotal, 2) ?> MT</span>
		</li>
		<li class="list-group-item px-0">
			<span class="f-w-600 text-capitalize"><?= 'Iva ('.tax().'%)' ?></span><span
				class="float-right cart-tax"><?= number_format($invoice->total - $invoice->subtotal, 2) ?>  MT</span>
		</li>
		<li class="list-group-item px-0">
			<span class="f-w-600">Total</span><span
				class="float-right cart-total"><?= number_format($invoice->total, 2) ?> MT</span>
		</li>
	</ul>
</div>
