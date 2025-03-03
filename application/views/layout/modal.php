<style>
	#header {
		height: 120px;
	}

	.div {
		width: 100%;
		height: 20px;
	}

	#footer {
		width: 100%;
		position: ;
		left: 0;
		bottom: 0;
		right: 0;
		height: 60px;
	}

	.border-dashed {
		border-bottom: #e3e6f0 1px dashed;
	}

	.border-dashed-all {
		border: #b9bcc6 1px dashed;
	}

	.table-border-dashed th,
	.table-border-dashed td {
		border: #b9bcc6 1px dashed !important;
	}
</style>
<div class="modal-content">
	<div class="modal-header bg-gray-200">
		<h5 class="modal-title" id="modal-sale-title">
			<i class="fa fa-file-pdf text-danger">&nbsp;</i>
			<span class="text-capitalize text-info">
				<?php if ($table === 'invoice') : ?>
					<?php if (isset($type_2)) : ?>
						<?= 'Guia de remessa ' . $delivery_id ?>
					<?php else : ?>
						<?= $this->lang->line('invoice') . ' ' . $code ?>
					<?php endif; ?>
				<?php elseif ($table == 'sale') : ?>
					<?php if ($select_doc == 1) {
						echo 'Guia de venda ' . $code;
					} else {
						echo 'VD ' . $code;
					} ?>

				<?php elseif ($table == 'quotation') : ?>
					<?= $this->lang->line('quotation') . ' ' . $code ?>
				<?php elseif ($table == 'payment') : ?>
					<?= $this->lang->line('receipt') . ' ' . $code ?>
				<?php elseif ($table == 'purchase') : ?>
					<?= $this->lang->line('invoice') . ' ' . $this->lang->line('of1') . ' ' . $this->lang->line('purchase') ?>
				<?php endif; ?>
			</span>
		</h5>
		<?php if ($table === 'invoice') : ?>
			<?php if (isset($type_2)) : ?>
				<button class="btn btn-sm btn-secondary float-right" id="btn-print" onclick="pdf_invoice_delivery(<?= $id ?>, 2)">
					<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
				</button>
			<?php else : ?>
				<button class="btn btn-sm btn-secondary float-right" onclick="getInvoice(<?= $id ?>,'print')">
					<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
				</button>
			<?php endif; ?>
		<?php elseif ($table === 'sale') : ?>
			<?php if (isset($type_2)) : ?>
				<button class="btn btn-sm btn-secondary float-right" id="btn-print" onclick="pdf_sale_delivery(<?= $id ?>)">
					<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
				</button>
			<?php else : ?>
				<button class="btn btn-sm btn-secondary float-right" onclick="get_sale(<?= $id ?>,'print')">
					<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
				</button>
			<?php endif; ?>
		<?php elseif ($table == 'quotation') : ?>
			<div>
				<?php if ($this->core_model->get_by_id('quotation', array('id' => $id))->was_sold) : ?>
					<button class="btn btn-sm btn-primary mr-4" id="btn-print-quotation-VD">
						<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') . ' VD' ?>
					</button>
				<?php endif ?>
				<button class="btn btn-sm btn-secondary float-right" onclick="printQuotation(<?= $id ?>)">
					<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
				</button>
			</div>

		<?php elseif ($table == 'payment') : ?>
			<button class="btn btn-sm btn-secondary float-right" onclick="get_payment_receipt(<?= $id ?>,'print')">
				<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
			</button>
		<?php elseif ($table == 'purchase') : ?>
			<button class="btn btn-sm btn-secondary float-right" onclick="get_purchase(<?= $id ?>,'print')">
				<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
			</button>
		<?php endif; ?>
	</div>
	<div class="modal-body px-5 pb-5" id="">
		<div id="header" style="margin-bottom: 100px">
			<div class="float-left" style="width: 45%; position: relative">
				<p style="position: absolute; top: 0">
					<?php if ($company->image) : ?>
						<?php if (is_file(FCPATH . $company->image)) : ?>
							<img width="175" src="<?= base_url($company->image) ?>" alt="image">
						<?php else : ?>
							<img width="175" src="<?= base_url('public/img/logo/invoice_logo.jpg') ?>" alt="image">
						<?php endif; ?>
					<?php else : ?>
						<img width="175" src="<?= base_url('public/img/logo/invoice_logo.jpg') ?>" alt="image">
					<?php endif; ?>
				</p>
				<div class="position-absolute pl-2" style="top: 90px">
					<?php if ($company->nuit) : ?>
						<p class="my-1">Nuit: <?= $company->nuit ?></p>
					<?php endif; ?>
					<?php if ($company->address) : ?>
						<p class="my-1"><?= ($company->address) . '' . ($company->city ? ', ' . $company->city : '') ?></p>
					<?php endif; ?>
					<p class="my-1">
						<?= $company->phone ? 'Cell: ' . $company->phone : '' ?> <?= ($company->phone2) ? ' / ' . $company->phone2 : '' ?> </p>
					<?php if ($company->email) : ?>
						<p class="my-1">Email: <?= $company->email ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="float-left pt-3" style="width: 22%;">

			</div>
			<?php if ($table === 'invoice') : ?>
				<?php if (isset($type_2)) : ?>
					<div class="float-right pt-3 position-relative" style="width: 33%;height: 80px;">
						<div class="position-absolute border-dashed-all" style="width: 100%; height: 80px; right: 0; top: 100px">
							<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280"> <?= $this->lang->line('Delivery_note') ?>
								Nº: <?= $delivery_id ?></p>
							<p class="my-0 text-right px-2"><?= $this->lang->line('Referring_to') . ' ' . $this->lang->line('invoice') ?>
								<?= $code . '/' . date_format(date_create($date_2), 'Y'); ?></p>
							<p class="my-0 text-right px-2"> <?= $this->lang->line('Issue_date') ?> : <?= $date; ?></p>
						</div>
					</div>
				<?php else : ?>
					<div class="float-right pt-3 position-relative" style="width: 33%;height: 80px;">
						<div class="position-absolute border-dashed-all" style="width: 100%; height: 80px; right: 0; top: 100px">
							<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280"><?= $this->lang->line('Invoice') ?>
								Nº: <?= $code ?></p>
							<p class="my-0 text-right px-2"><?= $this->lang->line('Issue_date') ?>
								: <?= $date . '/' . date_format(date_create($date), 'Y'); ?></p>
							<p class="my-0 text-right px-2"> <?= $this->lang->line('Expiration_Date') ?>
								: <?= $expired_date ?></p>
						</div>
					</div>
				<?php endif ?>
			<?php elseif ($table === 'quotation') : ?>
				<div class="float-right pt-3 position-relative" style="width: 33%;height: 80px;">
					<div class="position-absolute border-dashed-all" style="width: 100%; height: 80px; right: 0; top: 100px">
						<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280"><?= $this->lang->line('quotation') ?>
							Nº: <?= $code ?></p>
						<p class="my-0 text-right px-2"><?= $this->lang->line('Issue_date') ?>
							: <?= $date . '/' . date_format(date_create($date), 'Y'); ?></p>
						<p class="my-0 text-right px-2"> <?= $this->lang->line('Expiration_Date') ?>
							: <?= $due_date; ?></p>
					</div>
				</div>
			<?php elseif ($table === 'sale') : ?>
				<?php if (isset($type_2)) : ?>
					<div class="float-right pt-3 position-relative" style="width: 33%;height: 80px;">
						<div class="position-absolute border-dashed-all" style="width: 100%; height: 80px; right: 0; top: 100px">
							<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280"> <?= $this->lang->line('Delivery_note') ?>
								Nº: <?= $delivery_id ?></p>
							<p class="my-0 text-right px-2"><?= $this->lang->line('Referring_to') . ' ' . $this->lang->line('vd3') ?>
								: <?= $code . '/' . date_format(date_create($date_2), 'Y'); ?></p>
							<p class="my-0 text-right px-2"><?= $this->lang->line('Issue_date') ?>: <?= $date; ?></p>
						</div>
					</div>
				<?php else : ?>
					<div class="float-right pt-3 position-relative" style="width: 33%;height: 60px;">
						<div class="position-absolute border-dashed-all" style="width: 100%; height: 60px; right: 0; top: 120px">
							<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280">

								<?php if ($select_doc == 1) {
									echo 'GUIA DE VENDA ' . $code;
								} else { ?>
									<?= $this->lang->line('Referring_to') ?>
									(<?= $this->lang->line('vd3') ?>)
									Nº: <?= $code ?>
								<?php } ?>

							</p>
							<p class="my-0 text-right px-2"><?= $this->lang->line('Issue_date') ?>: <?= $date; ?></p>
						</div>
					</div>
				<?php endif ?>
			<?php endif ?>

			<?php if ($table === 'payment') : ?>
				<div class="float-right pt-3 position-relative" style="width: 30%;height: 60px;">
					<div class="position-absolute border-dashed-all" style="width: 100%; height: 60px; right: 0; top: 120px">
						<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280"><?= $this->lang->line('receipt') ?> Nº: <?= $code ?></p>
						<p class="my-0 text-right px-2"><?= $this->lang->line('Issue_date') ?>: <?= $date; ?></p>
					</div>
				</div>
			<?php endif ?>
			<?php if ($table === 'purchase') : ?>
				<div class="float-right pt-3 position-relative" style="width: 36%;height: <?= $invoice_number ? '80px' : '60px' ?>;">
					<div class="position-absolute border-dashed-all" style="width: 100%; height: <?= $invoice_number ? '80px' : '60px' ?>; right: 0; top: <?= $invoice_number ? '100px' : '120px' ?>">
						<p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280"><?= $select_doc == 1 ? 'Guia de compra' : $this->lang->line('purchase') ?>
							Nº: <?= $code ?></p>
						<?php if ($invoice_number) : ?>
							<p class="my-0 text-right px-2"><?= 'Nº ' . $this->lang->line('of2') . ' ' . $this->lang->line('invoice') . ' do fornecedor:' ?>
								<?= $invoice_number ?>
							</p>
						<?php endif; ?>
						<p class="my-0 text-right px-2"><?= $this->lang->line('Issue_date') ?>: <?= $date; ?></p>
					</div>
				</div>
			<?php endif ?>
		</div>


		<?php $t_name = 'cliente' ?>
		<?php if (isset($payment_target) || $table == 'purchase') : ?>
			<?php $t_name = 'fornecedor' ?>
			<?php $customer = empty($supplier_id) ? false : $this->core_model->get_by_id('supplier', array('id' => $supplier_id)) ?>
		<?php else : ?>
			<?php $customer = empty($customer_id) ? false : $this->core_model->get_by_id('customer', array('id' => $customer_id)) ?>
		<?php endif; ?>

		<table class="table table-border-dashed border-dashed-all">
			<tbody>
				<tr>
					<td class="border-dashed text-right bg-gray-200" style="width: 15%"><?= $this->lang->line('name') . ' ' . $this->lang->line('of') ?> <?= $t_name ?>:
					</td>
					<td class="border-dashed" style="width: 30%;"><?= ($customer) ? $customer->name : '' ?></td>
					<td class="border-dashed text-right bg-gray-200" style="width: 15%"><?= $this->lang->line('Code') . ' ' . $this->lang->line('of') ?> <?= $t_name ?>:
					</td>
					<td class="border-dashed text-right" style="width: 15%"><?= ($customer) ? $customer->code : '' ?></td>
				</tr>
				<tr>
					<td class="border-dashed text-right bg-gray-200 py-2" style="width: 15%">NUIT:</td>
					<td class="border-dashed" style="width: 30%"><?= ($customer) ? $customer->nuit : '' ?></td>
					<td class="border-dashed text-right bg-gray-200" style="width: 15%"><?= $this->lang->line('phone') ?>:
					</td>
					<td class="border-dashed text-right" style="width: 15%"><?= ($customer) ? $customer->phone : '' ?><?= ($customer) ? ($customer->phone2) ? ' / ' . $customer->phone2 : '' : '' ?></td>
				</tr>
				<tr>
					<td class="border-dashed text-right bg-gray-200" style="width: 15%"><?= $this->lang->line('address') ?>
						:
					</td>
					<td class="border-dashed" style="width: 30%;"><?= ($customer) ? $customer->address : '' ?></td>
					<td class="border-dashed text-right bg-gray-200" style="width: 15%">Email:</td>
					<td class="border-dashed text-right" style="width: 30%"><?= ($customer) ? $customer->email : '' ?></td>
				</tr>
			</tbody>
		</table>
		<?php $extenso = $this->core_model->por_extenso(this_number_format($total, 2, ',', '')) ?>

		<?php if ($table == 'invoice' || $table == 'sale' || $table == 'quotation' || $table == 'purchase') : ?>
			<table class="table table-sm">
				<thead>
					<tr class="bg-light">
						<th class="border-top text-right border-left border-right" style="width: 5%"><?= $this->lang->line('quantity') ?></th>

						<th class="border-top border-left border-right text-center" style="width: 20%"> <?= 'Codigo' ?></th>

						<th class="border-top border-left border-right text-left" style="width: <?= $table == 'purchase' ? 35 : 55 ?>%"> <?= $this->lang->line('name') ?></th>
						<th class="border-top border-right text-right" style="width: 20%"><?= $this->lang->line('Unit_price') ?></th>
						<th class="border-top border-right text-right" style="width: 20%">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0 ?>
					<?php if ($table == 'invoice' || $table == 'sale' || $table == 'quotation') : ?>
						<?php foreach ($items as $item) : ?>
							<?php $price = $item->other_price == 0 ? $item->price : $item->other_price ?>
							<tr>
								<td class="border-bottom border-right border-left text-center"><?= $item->quantity ?></td>
								<td class="border-bottom text-center text-center"><?= $item->barcode ?></td>
								<td class="border-bottom"><?= $item->product ?></td>
								<td class="border-bottom text-right border-left border-right"><?= this_number_format($price) ?></td>
								<td class="border-bottom text-right border-right"><?= this_number_format($price * $item->quantity) ?></td>
							</tr>
							<?php $counter += 1 ?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php foreach ($items as $item) : ?>
							<tr>
								<td class="border-bottom border-right border-left text-center"><?= $item->quantity ?></td>
								<td class="border-bottom text-center text-center"><?= $item->barcode ?></td>
								<td class="border-bottom"><?= $item->product ?></td>
								<td class="border-bottom text-right border-left border-right"><?= this_number_format($item->price) ?></td>
								<td class="border-bottom text-right border-right"><?= this_number_format($item->price * $item->quantity) ?></td>
							</tr>
							<?php $counter += 1 ?>
						<?php endforeach; ?>
					<?php endif ?>

					<?php for (
						$i = $counter;
						$i <= 12;
						$i++
					) : ?>
						<tr class="">
							<td colspan="<?= $table == 'purchase' ? 5 : 5 ?>" class="bg-light border-left border-right border-top-0 <?= $i == 12 ? 'border-bottom' : 'border-bottom-0' ?>">
								&nbsp;
							</td>
						</tr>
					<?php endfor ?>
					<tr>
						<td colspan="<?= $table == 'purchase' ? 3 : 3 ?>" class="border-right"></td>
						<td class="text-right f-w-700" colspan="1">SUBTOTAL</td>
						<td class="text-right border"><?= this_number_format($subtotal, 2) ?></td>
					</tr>
					<?php if ($table != 'purchase') : ?>
						<tr>
							<td colspan="<?= $table == 'purchase' ? 3 : 3 ?>" class="border-right border-top-0">
							</td>
							<td class="text-right f-w-700 text-uppercase" colspan="1"><?= $this->lang->line('discount') ?></td>
							<td class="text-right border"><?= this_number_format($discount, 2) ?></td>
						</tr>
					<?php endif; ?>
					<tr>
						<td colspan="<?= $table == 'purchase' ? 3 : 3 ?>" class="border-right border-top-0">
						</td>
						<td class="text-right f-w-700 text-uppercase" colspan="1"><?= 'Iva ( 16% )' ?></td>
						<td class="text-right border"><?= this_number_format($tax, 2) ?></td>
					</tr>
					<?php if ($table == 'purchase') : ?>
						<tr>
							<td colspan="<?= $table == 'purchase' ? 3 : 2 ?>" class="border-right border-top-0">
							</td>
							<td class="text-right f-w-700 text-uppercase" colspan="1"><?= $this->lang->line('discount') ?></td>
							<td class="text-right border"><?= this_number_format($discount, 2) ?></td>
						</tr>
					<?php endif; ?>
					<tr>
						<td colspan="<?= $table == 'purchase' ? 3 : 3 ?>" class="border-right border-top-0"></td>
						<td class="text-right f-s-14 f-w-700 bg-light border-bottom" colspan="1">TOTAL</td>
						<td class="text-right f-s-14 f-w-700 bg-light border"><?= this_number_format($total, 2) ?></td>
					</tr>
				</tbody>
			</table>
			<div class="position-relative">
				<p class="position-absolute" style="top: -45px; width: 60%">
					<?= str_replace(',', ' e ', str_replace('um mil', 'Mil', $extenso)) . '.' ?>
				</p>
			</div>
		<?php endif; ?>

		<?php if ($table == 'payment') : ?>
			<table class="table table-sm">
				<thead>
					<tr class="bg-light">
						<th class="border-top text-right border-left border-right text-capitalize" style="width: 20%">
							<?= $this->lang->line('document') ?>
						</th>
						<th class="border-top border-left border-right text-capitalize" style="width: 30%"><?= $this->lang->line('number') ?></th>
						<th class="border-top border-right text-right" style="width: 25%"><?= $this->lang->line('amount') . '' . $this->lang->line('of2') . ' ' . $this->lang->line('invoice') ?>
						</th>
						<th class="border-top border-right text-right" style="width: 25%"><?= $this->lang->line('Amount_paid') ?></th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0 ?>
					<?php if ($type == 'invoice') : ?>
						<?php foreach ($invoices as $invoice) : ?>
							<tr>
								<td class="border-bottom border-right border-left text-center"><?= 'FA' ?></td>
								<td class="border-bottom"><?= 'FT-' . $invoice->invoice_number ?></td>
								<td class="border-bottom text-right border-left border-right"><?= this_number_format($invoice->invoice_total) ?></td>
								<td class="border-bottom text-right border-left border-right"><?= this_number_format($invoice->value) ?></td>
							</tr>
							<?php $counter += 1 ?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php foreach ($purchases as $purchase) : ?>
							<tr>
								<td class="border-bottom border-right border-left text-center"><?= 'FA' ?></td>
								<td class="border-bottom"><?= 'FT-' . $purchase->purchase_number ?></td>
								<td class="border-bottom text-right border-left border-right"><?= this_number_format($purchase->purchase_total - $purchase->discount) ?></td>
								<td class="border-bottom text-right border-left border-right"><?= this_number_format($purchase->value) ?></td>
							</tr>
							<?php $counter += 1 ?>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php for (
						$i = $counter;
						$i <= 12;
						$i++
					) : ?>
						<tr class="">
							<td colspan="4" class="bg-light border-left border-right border-top-0 <?= $i == 12 ? 'border-bottom' : 'border-bottom-0' ?>">
								&nbsp;
							</td>
						</tr>
					<?php endfor ?>

					<tr class="">
						<td colspan="2" class="border-right border-top-0">
						</td>
						<td class="text-right f-s-18 f-w-700 border-bottom" colspan="1"><?= $this->lang->line('Total_paid') ?></td>
						<td class="text-right f-s-18 f-w-700 border"><?= this_number_format($payment->amount, 2) ?></td>
					</tr>
				</tbody>
			</table>
			<div class="position-relative">
				<p class="position-absolute" style="top: -50px; width: 60%">
					<?= str_replace(',', ' e ', str_replace('um mil', 'Mil', $extenso)) . '.' ?>
				</p>
			</div>
		<?php endif; ?>

		<?php if (isset($type_2)) : ?>
			<br>
			<br>
			<div class="row" style="width: 100%; display: flex">
				<div class="col-6">
					<p class="text-center mb-4"> <?= $this->lang->line('Delivered_by') ?> :</p>
					<hr class="">
				</div>
				<div class="col-6">
					<p class="text-center mb-4"> <?= $this->lang->line('Received_by') ?> :</p>
					<hr>
				</div>
			</div>
		<?php else : ?>
			<?php if ($table == 'sale' || $table == 'payment') : ?>
				<p class="mt-3"><strong><?= $this->lang->line('payment') ?></strong></p>
				<div class="row">
					<div class="col-6">
						<table class="table border-dashed-all">
							<tbody>
								<tr>
									<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= $this->lang->line('Forms') . ' ' . $this->lang->line('of2') . ' ' . $this->lang->line('payment') ?>
									</td>
									<td class="border-dashed text-right" style="width: 50%;">
										<?php $parent = $this->sale_model->get_parent($payment->method_id); ?>
										<?= !empty($parent) ? $parent->name . ' | ' : '' ?>
										<?= $payment_method_name ?>
									</td>
								</tr>
								<tr>
									<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= $this->lang->line('Amount_paid') ?></td>
									<td class="border-dashed text-right" style="width: 50%;">
										<?= this_number_format($payment->amount, 2) ?>
									</td>
								</tr>
								<?php if ($payment->method_id == 1) : ?>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= $this->lang->line('amount_received') ?>
										</td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= this_number_format($payment->total_paid, 2) ?>
										</td>
									</tr>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= $this->lang->line('change') ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= this_number_format($payment->change, 2) ?>
										</td>
									</tr>
								<?php endif; ?>
								<?php if ($this->core_model->get_by_id('payment_method', array('id' => $payment->method_id))->parent_id == 4) : ?>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Referência' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->reference ?>
										</td>
									</tr>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Titular' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->holder ?>
										</td>
									</tr>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Número de telefone' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->mobile_number ?>
										</td>
									</tr>
								<?php endif; ?>
								<!--					bank service check-->
								<?php if ($payment->method_id == 3) : ?>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Nome do banco' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->check_bank ?>
										</td>
									</tr>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Número do cheque' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->check_number ?>
										</td>
									</tr>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Número da conta' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->account ?>
										</td>
									</tr>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Titular' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->holder ?>
										</td>
									</tr>
								<?php endif; ?>
								<!--					bank service-->
								<?php if ($payment->method_id == 12) : ?>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Nome do banco' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->check_bank ?>
										</td>
									</tr>
									<?php if ($payment->account) : ?>
										<tr>
											<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Número da conta' ?></td>
											<td class="border-dashed text-right" style="width: 50%;">
												<?= $payment->account ?>
											</td>
										</tr>
									<?php endif; ?>
									<?php if ($payment->nib) : ?>
										<tr>
											<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'NIB' ?></td>
											<td class="border-dashed text-right" style="width: 50%;">
												<?= $payment->nib ?>
											</td>
										</tr>
									<?php endif; ?>
									<tr>
										<td class="border-dashed text-right bg-gray-200" style="width: 50%"><?= 'Titular' ?></td>
										<td class="border-dashed text-right" style="width: 50%;">
											<?= $payment->holder ?>
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php elseif ($table == 'invoice' || $table == 'invoice') : ?>
				<div class="row">
					<div class="pr-2 f-s-10 col-6">
						<?php if ($company->invoice_note) : ?>
							<p class="f-s-10 p-2" style="text-align: justify; border: 1px dashed #dede00">
								<?= $company->invoice_note ?>
							</p>
						<?php endif; ?>
						<?php $bank_accounts = $this->core_model->get_all('bank_account', array('active' => 1)) ?>
						<?php if (count($bank_accounts)) : ?>
							<fieldset class="pb-0 py-0 mx-0" style="border: 1px solid #e3e6f0;">
								<legend style="top: -10px" class="f-s-12"><?= $this->lang->line('bank_data') ?></legend>
								<table class="table table-sm my-0 py-0">
									<tr>
										<th style="width: 16%" class="border-top-0"></th>
										<th style="width: 83%" class="border-top-0"></th>
									</tr>
									<?php foreach ($bank_accounts as $bank_account) : ?>
										<?php $bank_name = $this->core_model->get_by_id('bank', array('id' => $bank_account->bank_id))->name ?>
										<tr class="py-0 my-0">
											<td class="text-right border-top-0 py-0"><?= $bank_name ?>:</td>
											<td class="pl-5 border-top-0 py-0"><?= $bank_account->number ?></td>
										</tr>
									<?php endforeach; ?>
								</table>
							</fieldset>
						<?php endif; ?>
					</div>
					<div class="pt-4 col-6">
						<br>
						<br>
						<br>
						<p class="border-bottom text-center mb-3"></p>
						<br>
						<p class="text-center">( <?= $this->lang->line('commercial_department') ?>)</p>
					</div>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-12">
					<?php if ($table != 'purchase') : ?>
						<p class="text-center f-s-10 my-0">
							<?= $this->lang->line('for_preference') ?>
						</p>
					<?php endif; ?>
					<p class="my-0 f-s-10">
						<span class=""><?= $this->lang->line('document_processed') ?>/ © <?= $company->name ?></span>
						<span class="float-right page"><?= $this->lang->line('page') ?> 1</span>
					</p>
				</div>
			</div>
		<?php endif; ?>

	</div>

	<div class="modal-footer bg-gray-200">
		<div class="d-flex justify-content-between w-100">
			<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
				<?= $this->lang->line('cancel') ?>
			</button>

			<?php if ($table === 'invoice') : ?>
				<?php if (!isset($type_2)) : ?>
					<?php if ($this->core_model->get_by_id('delivery_note', array('fatura_id' => $id))) : ?>
						<button class="btn btn-sm btn-success mr-lg-1 d-none" onclick="printDelivery(<?= $id ?>)"><i class="fas fa-print"></i>
							<?= $this->lang->line('print') . ' ' . $this->lang->line('Delivery_note') ?>
						</button>
					<?php else : ?>
						<form id="form-delivery">
							<input type="hidden" name="fatura_id" value="<?= $id ?>">
							<small class="form-text text-danger"><?php echo form_error('fatura_id', ''); ?> </small>
							<button class="btn btn-sm btn-primary float-right d-none"><i class="fas fa-dolly-flatbed"></i>
								&nbsp;
								<?= $this->lang->line('new') . ' ' . $this->lang->line('Delivery_note') ?>
							</button>
						</form>
					<?php endif; ?>
				<?php endif; ?>
			<?php elseif ($table === 'sale') : ?>
				<?php if (!isset($type_2)) : ?>
					<?php if ($this->core_model->get_by_id('delivery_note', array('sale_id' => $id))) : ?>
						<button class="btn btn-sm btn-success mr-lg-1 d-none"><i class="fas fa-print"></i>
							<?= $this->lang->line('print') . ' ' . $this->lang->line('Delivery_note') ?>
						</button>
					<?php else : ?>
						<form id="form-delivery d-none">
							<input type="hidden" name="sale_id" value="<?= $id ?>">
							<small class="form-text text-danger"><?php echo form_error('sale_id', ''); ?> </small>
							<button class="btn btn-sm btn-primary float-right"><i class="fas fa-dolly-flatbed"></i>
								&nbsp;
								<?= $this->lang->line('new') . ' ' . $this->lang->line('Delivery_note') ?>
							</button>
						</form>
					<?php endif; ?>
				<?php endif; ?>
			<?php elseif ($table === 'quotation') : ?>
				<?php if (!$quotation->was_sold) : ?>
					<?php if ($this->ion_auth->in_group(array('admin', 'super admin'))) : ?>
						<a href="<?= base_url('edit-quotation/' . $quotation->id) ?>" title="<?= $this->lang->line('quotation') ?>" class="btn btn-sm btn-outline-secondary text-capitalize ml-2">
							<i class="feather icon-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>


<?php if ($table == 'quotation') : ?>
	<!--Receipt-->
	<div id="frame"></div>
	<div id="receipt-vd" class="d-none">
		<style>
			#frame {
				font-family: "Tw Cen MT";
				/*font-size: 42pt;*/
			}

			#title {
				text-align: center;
				margin-bottom: 4rem;
				font-size: 35pt;
				text-transform: uppercase;
			}

			#table {
				width: 100%;
				margin-bottom: 1rem;
				border-bottom: 1px solid #e3e6f0;
			}

			#table th,
			#table td {
				padding: 0.4rem;
				vertical-align: center;
				margin: 0;
				font-size: 25pt;
			}

			#table th:nth-child(1) {
				text-align: left;
			}

			#table th:nth-child(2) {
				text-align: left;
			}

			#table th:nth-child(3) {
				text-align: right;
			}

			#table th:nth-child(4) {
				text-align: right;
			}

			#table td {
				border-top: 1px solid #e3e6f0;
			}

			#table td:nth-child(1) {
				text-align: center;
			}

			#table td:nth-child(2) {
				text-align: left;
			}

			#table td:nth-child(3) {
				text-align: right;
			}

			#table td:nth-child(4) {
				text-align: right;
			}

			/*	table summary*/
			#table-summary {
				width: 100%;
				margin-top: 3rem;
			}

			#table-summary td {
				padding: 0.4rem;
				vertical-align: center;
				text-align: right;
				font-size: 25pt;
			}


			#footer {
				text-align: center;
				font-size: 25pt;
				margin-top: 3rem;
			}

			.text-center {
				text-align: center
			}

			.text-right {
				text-align: right;
			}

			.p {
				font-size: 20pt;
			}

			.mb-0,
			.my-0 {
				margin-bottom: 0.4rem !important;
			}

			.mt-0,
			.my-0 {
				margin-bottom: 0.4rem !important;
			}
		</style>
		<?php
		$company = $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));
		?>
		<h1 id="title"><?= $company->name ?></h1>
		<?php if ($company->nuit) : ?>
			<p class="p my-0">Nuit: <?= $company->nuit ?></p>
		<?php endif; ?>
		<?php if ($company->address) : ?>
			<p class="p my-0"><?= ($company->address) . '' . ($company->city ? ', ' . $company->city : '') ?></p>
		<?php endif; ?>
		<?php if ($company->phone) : ?>
			<p class="p my-0">
				<?= 'Cell: ' . $company->phone . '' . ($company->phone2 ? ' / ' . $company->phone2 : '') ?>
			</p>
		<?php endif; ?>

		<p style="margin-top: 4rem;" class="text-center p">
			Nº:&nbsp;<?= isset($is_new) ? $this->core_model->code_generator('sale') : $code ?>
		</p>

		<p class="text-center p">
			<?= $this->lang->line('date') ?>
			: <?= isset($is_new) ? date('d-m-Y H:i') : date_format(date_create($date), 'd-m-Y H:i'); ?>
		</p>
		<p class="p text-right"><?= $this->lang->line('currency') ?>: Metical</p>

		<table id="table">
			<thead>
				<tr>
					<th style="width: 10%">Qtd</th>
					<th style="width: 50%">Item</th>
					<th style="width: 20%"><?= $this->lang->line('price') ?></th>
					<th style="width: 20%">Subtotal</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($items as $item) : ?>
					<?php $price = $item->other_price == 0 ? $item->price : $item->other_price ?>
					<tr>
						<td><?= $item->quantity ?></td>
						<td><?= $item->product ?></td>
						<td><?= this_number_format($price, 2) ?></td>
						<td><?= this_number_format($price * $item->quantity, 2) ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<table id="table-summary">
			<thead>
				<tr>
					<th style="width: 70%"></th>
					<th style="width: 30%"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="">Subtotal:</td>
					<td><?= this_number_format($subtotal, 2) ?></td>
				</tr>
				<tr>
					<td>Iva ( 16% ):</td>
					<td><?= this_number_format($tax, 2) ?></td>
				</tr>
				<tr>
					<td>Total:</td>
					<td><?= this_number_format($total, 2) ?></td>
				</tr>
			</tbody>
		</table>
		<p id="footer"><?= $this->lang->line('thank_soon') ?></p>
	</div>
<?php endif; ?>
<script>
	$(document).on('submit', '#form-delivery', function(e) {
		e.preventDefault();
		// console.log('submited')
		$.ajax({
			url: baseURL + 'delivery_note/save',
			type: 'POST',
			dataType: "JSON",
			data: new FormData(this),
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				show_loader();
			},
			success: function(data) {
				console.log(data)
				$("#loader").hide();
				if (data.status.toString() === 'success') {
					show_toast_success(data.message)
					$('#modal-sm-2').modal('toggle')
				}
				if (data.status.toString() === 'error') {
					alert(data.message)
				}
				if (data.status.toString() === 'error_validation') {
					setErrorValidation(data)
				}
				close_loader();
			},
			error: function(xhr, status, error) {
				close_loader();
				console.log(JSON.stringify(error))
			}
		})
	});

	function printDelivery(id) {
		Swal.fire({
			title: "",
			text: "Desejas imprimir a guia de entrega?",
			icon: "question",
			confirmButtonColor: "#00a897",
			confirmButtonText: "<i class='feather icon-printer mr-2'></i>Sim",
			cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
			cancelButtonClass: 'bg-dark',
			showCancelButton: true,
		}).then(function(rs) {
			if (rs.isConfirmed) {
				$.ajax({
					url: baseURL + 'delivery_note/printDelivery',
					type: 'GET',
					data: {
						'id': id
					},
					// dataType: "JSON",
					success: function(data) {
						// console.log(data)
						// $('#modal-sale-content').html(data);
						// $('#modal-sale').modal('show');
						printElem(data);
					},
					error: function(data) {
						console.log('error: ' + data)
					}
				});

			}
		});
	}

	$(document).on('click', '#btn-print-quotation-VD', function() {
		printElemVD($('#receipt-vd').html());
	});

	function printElemVD(html) {
		printJS({
			printable: 'frame',
			type: 'html',
			header: html,
			style: '#titlee{color:green};',
			font: "TwCenMT",
			font_size: "14pt",
		});
	}
</script>