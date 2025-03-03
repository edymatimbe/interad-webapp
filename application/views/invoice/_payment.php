<div class="modal-content">

	<div class="modal-header">
		<h5 class="modal-title" id="modal-sale-title">
			<i class="fa fa-list">&nbsp;</i>
			<span class="text-info">

			<?= $this->lang->line('payment') . ' ' . $this->lang->line('of2') . ' ' . $this->lang->line('invoice') . ' ' . $code ?>
		</span>
		</h5>
		<button class="btn btn-sm btn-secondary float-right" id="btn-print" onclick="getInvoice(<?= $id ?>,'print')">
			<i class="feather icon-printer">&nbsp;</i>
			<?= $this->lang->line('print') ?>
		</button>
	</div>
	<div class="modal-body bg-gray-200" id="">

		<h6 class="f-s-14 text-gray-600 f-w-600  bg-white rounded shadow-sm p-3">
			<i class="feather icon-user">&nbsp;</i> <?= $this->lang->line('customer').': '. $customer->name ?>
		</h6>
		<hr>

		<div class="row mb-5">
			<div class="col-md-4">
				<ul class="list-group f-s-15">
					<li class="list-group-item ">
						<span class="f-w-600">Subtotal</span><span
							class="float-right cart-subtotal"><?= number_format($subtotal, 2) ?> MT</span>
					</li>
					<li class="list-group-item ">
						<span class="f-w-600 text-capitalize"><?= $this->lang->line('Iva') ?></span><span
							class="float-right cart-tax"><?= number_format($tax, 2) ?>  MT</span>
					</li>
					<li class="list-group-item ">
						<span class="f-w-600"><?= $this->lang->line('total_to_pay')  ?></span><span
							class="float-right cart-total"><?= number_format($total, 2) ?> MT</span>
					</li>
					<li class="list-group-item text-success">
						<span class="f-w-600">Total <?= $this->lang->line('Total_paid')  ?></span><span
							class="float-right cart-total"><?= number_format($totalPaid, 2) ?> MT</span>
					</li>
					<li class="list-group-item text-danger">
						<span class="f-w-600"><?= $this->lang->line('Debt')  ?></span><span
							class="float-right cart-total"><?= number_format($debt, 2) ?> MT</span>
					</li>
				</ul>
			</div>

			<div class="col-md-8">
				<div class="card">
					<div class="card-header pb-1">
						<h6 class="card-title f-s-14">
							<i class="feather icon-list mr-2"></i>Pagamentos efectuados
						</h6>
					</div>
					<div class="card-body pb-0">
						<table class="table table-bordered table-sm">
							<thead>
							<tr class="text-muted f-w-300">
								<th class="text-center">#</th>
								<th class="text-right"><?= $this->lang->line('Amount_paid')  ?></th>
								<th class="text-center"><?= $this->lang->line('Payday')  ?></th>
								<th style="width: 10%" class="text-center no-sort"><?= $this->lang->line('actions') ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $counter = 1; ?>
							<?php foreach ($payments as $item): ?>
								<tr class="text-nowrap">
									<td class="text-center"><?= $counter ?></td>
									<td class="text-right px-2"><?=number_format($item->amount,2).' MT'?></td>
									<td class="text-center">
										<?= date_format(date_create($item->created_at), 'd/m/Y H:i') ?>
									</td>
									<td class="text-center">
										<button class="btn btn-xs btn-outline-secondary text-capitalize" onclick="get_payment_receipt(<?=$item->id?>,'modal')">
											<i class="fa fa-file-pdf-o text-danger mr-1"></i>
											<?= $this->lang->line('receipt') ?>
										</button>
									</td>
								</tr>
								<?php $counter += 1 ?>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
