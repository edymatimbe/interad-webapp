<div class="card">
	<div class="card-body pb-0">
		<input type="hidden" id="source" value="<?= $source ?>">
		<div class="form-group inputBox no-icon">
					<textarea
						placeholder="Escreva a razão da edição da factura"
						class="form-control" name="note" id="reason_note" style="resize: none" rows="4"><?=get_cookie('reason_note')?></textarea>
			<label for="reason_note">Nota (Motivo da retificação)</label>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h6 class="card-title text-agata mb-0" id="render_type">
			<i class="feather icon-list"></i>
			Items da Nota de <?= $source == 'credit' ? 'crédito' : 'débito' ?>
		</h6>
	</div>
	<div class="card-body">
		<div class="d-flex flex-column justify-content-between h-100">
			<div class="table-responsive" id="div-table" style="overflow-x: auto; overflow-y: auto">
				<table class="table table-bordered table-hover" id="table-edit-invoice">
					<thead>
					<tr class="">
						<th class="text-capitalize"><?= $this->lang->line(is_service() ? 'service' : 'product') ?></th>
						<th class="text-right"><?= $this->lang->line('price') ?></th>
						<th class="text-right"><?= $this->lang->line('quantity') ?></th>
						<th class="text-right"><?= 'Subtotal' ?></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->cart_service->contents() as $product): ?>
						<?php $price = $product['price'] ?>
						<tr class="accordion-toggle collapsed cursor-pointer">
							<td class="align-middle"><?= $product['name'] ?></td>
							<td class="text-right align-middle"><?= number_format($price, 2) ?></td>
							<td class="text-right align-middle"><?= $product['qty'] ?></td>
							<td class="text-right align-middle"><?= number_format($product['qty'] * $price, 2) ?></td>
							<td class="text-center">
								<a class="btn btn-sm btn-outline-agata expand-button text-center"
								   id="accordion-<?= $product['id'] ?>"
								   data-toggle="collapse"
								   data-parent="#accordion-<?= $product['id'] ?>"
								   href="#collapse-<?= $product['id'] ?>">
									<i class="feather icon-edit text-dark"></i>
								</a>
								<button class="btn btn-sm btn-outline-danger ml-3 expand-button text-center btn-remove"
										data-id="<?= $product['rowid'] ?>">
									<i class="feather icon-trash"></i>
								</button>
							</td>
						</tr>

						<tr class="hide-table-padding">
							<td colspan="7" class="bg-light">
								<div
									id="collapse-<?= $product['id'] ?>"
									class="collapse in p-3 table-collapse">
									<div class="card shadow-none border mb-0">
										<div class="card-body pb-0">
											<form class="form-item" autocomplete="off">
												<input type="hidden" name="rowid" value="<?= $product['rowid'] ?>">
												<div class="row mb-0">
													<div class="col-md-10">
														<div class="row">
															<div class="col-md-4">
																<div class="inputBox no-icon form-group mb-0">
																	<input type="text" data-value="<?= $price ?>"
																		   class="form-control-bs price"
																		   data-id="<?= $product['id'] ?>"
																		   id="price-<?= $product['id'] ?>"
																		   name="price" required
																		   value="<?= $price ?>">
																	<label
																		for="price-<?= $product['id'] ?>"><?= $this->lang->line('price') ?>
																	</label>
																</div>
															</div>
															<div class="col-md-4">
																<div class="inputBox no-icon form-group mb-0">
																	<input class="quantity" data-value="<?= $product['qty'] ?>"
																		   data-id="<?= $product['id'] ?>"
																		   type="number" name="quantity"
																		   value="<?= $product['qty'] ?>"
																		   min="1" required
																		   id="quantity-<?= $product['id'] ?>">
																	<label
																		for="quantity-<?= $product['id'] ?>"><?= $this->lang->line('quantity') ?></label>
																</div>
															</div>
															<div class="col-md-4">
																<div class="inputBox no-icon form-group mb-0">
																	<input type="text" name="subtotal"
																		   value="<?= number_format($product['qty'] * $price, 2) ?>"
																		   id="subtotal-<?= $product['id'] ?>"
																		   readonly>
																	<label
																		for="subtotal-<?= $product['id'] ?>"><?= 'Subtotal' ?></label>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-2 pt-1">
														<button type="submit"
																class="btn btn-sm btn-success btn-block"><i
																class="feather icon-save mr-2"></i><?= $this->lang->line('save') ?>
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
			<div class="">
				<ul class="list-group list-group-flush f-s-15 px-2">
					<?php $cart = $this->cart_model->cart_resume(true);?>
					<?php if ($invoice->discount > 0): ?>
						<li class="list-group-item px-0">
							<span class="f-w-600 text-capitalize"><?= $this->lang->line('discount') ?></span>
							<span
								class="float-right cart-discount"><?= number_format($invoice->discount, 2) ?> MT</span>
						</li>
					<?php endif ?>

					<li class="list-group-item px-0">
						<span class="f-w-600">Subtotal</span><span
							class="float-right cart-subtotal"><?= number_format($cart['subtotal'], 2) ?> MT</span>
					</li>
					<li class="list-group-item px-0">
						<span class="f-w-600 text-capitalize"><?='Iva ( '.tax().' %)'?></span><span
							class="float-right cart-tax"><?= number_format($cart['total_iva'], 2) ?>  MT</span>
					</li>
					<li class="list-group-item px-0">
						<span class="f-w-600">Total</span><span
							class="float-right cart-total"><?= number_format($cart['total'], 2) ?> MT</span>
					</li>
				</ul>
				<p class="mb-0 text-right border-top pt-3">
					<?php $text = $this->cart_service->total_items() > 0 ?'salvar nota de ' . ($source == 'credit' ? 'crédito' : 'débito'):'anular factura'?>
					<button class="btn btn-success  f-w-600 text-uppercase" onclick="save_note('<?=$text?>')">
						<i class="feather icon-save mr-2"></i>
						<?=  $text ?>
					</button>
				</p>
			</div>
		</div>
	</div>
</div>




