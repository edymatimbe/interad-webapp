<div class="d-flex flex-column justify-content-between h-100">
	<ul class="list-group list-group-flush mb-lg-2 scroll cart-inside" id="list-selected-items"
		style="overflow-x: hidden; overflow-y: auto">
		<?php foreach ($this->cart_service->contents() as $item): ?>
			<?php $option = $this->cart_service->product_options($item['rowid']) ?>
			<?php $image = $option['image'] ?>
			<li class="list-group-item pr-0 cursor-pointer line-item border-bottom">
				<div class="row">
					<div class="col-1 px-0">
						<?php if ($image): ?>
							<?php if (is_file(FCPATH . $image)): ?>
								<img class="my-border-radius shadow-sm" width="60" src="<?= base_url($image) ?>"
									 alt="image">
							<?php else: ?>
								<img class="my-border-radius shadow-sm" width="60"
									 src="<?= base_url('public/img/camera.png') ?>" alt="image">
							<?php endif; ?>
						<?php else: ?>
							<img class="my-border-radius shadow-sm" width="60"
								 src="<?= base_url('public/img/camera.png') ?>" alt="image">
						<?php endif; ?>
					</div>
					<div class="col-9 d-flex flex-column justify-content-center">
						<div class="row my-0 py-0">
							<div class="col-6 pt-2">
								<p class="f-w-600 pl-3">
									<?= $item['name'] ?>
								</p>
							</div>
							<div class="col-3 pt-2">
								<span><?= $this->cart->format_number($item['qty']) ?></span>
							</div>
							<div class="col-3 pt-3">
							<span class="float-right">
								<?= $this->cart_service->format_number($item['subtotal']) ?>
							</span>
							</div>
						</div>
					</div>
					<div class="col-2 d-flex flex-column justify-content-center px-0">
						<p class="text-center pt-4">
							<?php if ($this->ion_auth->in_group(array('admin', 'super admin', 'v'))): ?>
								<button class="btn btn-rounded btn-xs btn-outline-primary mr-3" type="button"
										data-toggle="collapse" data-target="#collapse-<?= $item['rowid'] ?>"
										aria-expanded="false" aria-controls="collapseExample">
									<i class="feather icon-edit"></i>
								</button>
							<?php endif; ?>
							<span class="btn btn-rounded btn-xs btn-outline-danger"
								  onclick="removeItemService('<?= $item['rowid'] ?>','service')">
								<i class="fa fa-times"></i>
							</span>
						</p>
					</div>
				</div>

				<div class="row d-flex justify-content-end">
					<div class="col-12 pl-0 collapse" id="collapse-<?= $item['rowid'] ?>">
						<div class="card shadow-none border rounded bg-light">
							<div class="card-body">
								<form action="" class="form-cart-item">
									<div class="row">
										<input type="hidden" name="id" value="<?= $item['rowid'] ?>">
										<input type="hidden" name="product_id" value="<?= $item['id'] ?>">
										<div class="col-md-3 form-group">
											<label
												for="price-<?= $item['rowid'] ?>"><?= $this->lang->line('price') ?></label>
											<input type="text" class="form-control f-s-20 text-right number item-price"
												   name="price" id="price-<?= $item['rowid'] ?>"
												   data-id="<?= $item['rowid'] ?>"
												   value="<?= $item['price'] ?>" required>
										</div>

										<div class="col-md-3 form-group">
											<label
												for="quantity-<?= $item['rowid'] ?>"><?= $this->lang->line('quantity') ?></label>
											<input type="number" min="1" class="form-control f-s-20 number"
												   id="quantity-<?= $item['rowid'] ?>"
												   data-id="<?= $item['rowid'] ?>" required
												   name="quantity" value="<?= $item['qty'] ?>">
										</div>
										<div class="col-md-3 form-group">
											<label for="total-<?= $item['rowid'] ?>"
												   class="text-capitalize"><?= 'total' ?></label>
											<input id="total-<?= $item['rowid'] ?>" type="text" readonly
												   value="<?= number_format($item['qty'] * $item['price'], 2) ?>"
												   class="form-control f-s-20 text-right bg-light">
										</div>

										<div class="col-md-3 form-group pt-4">
											<button type="submit" class="btn btn-success mt-1 float-right"><i
													class="feather icon-save mr-2"></i>Salvar
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="">
		<ul class="list-group list-group-flush mb-4 f-s-15" id="ul-values">
			<li class="list-group-item px-0">
				<span class="f-w-600">Total </span><span
					class="float-right cart-subtotal"><?= number_format($subtotal_cart, 2) ?> MT</span>
			</li>
		</ul>
		<div class="pb-4 d-flex justify-content-between">
			<button class="btn btn-agata f-w-600 text-uppercase"
				<?= ($total > 0.0 && ($customer_id)) ? '' : 'disabled' ?> id="btn-show-invoice-service">
				<i class="feather icon-file-text mr-2"></i>Ver factura
			</button>
			<?php if ($source === 'invoice'): ?>
				<?php $text_btn =  $this->lang->line('save') . ' ' . $this->lang->line('invoice')?>

				<button class="btn btn-success f-w-600 text-uppercase"
						onclick="save_invoice_service('<?= base_url('invoice/save_invoice_service') ?>','<?=strtoupper($text_btn)?>')"
					<?= (($total > 0.0) && ($customer_id)) ? '' : 'disabled' ?>>
					<i class="feather icon-save"></i>
					<span><?= $text_btn ?></span>
				</button>
			<?php elseif ($source == 'quotation'): ?>
				<?php if (isset($is_edit)): ?>
					<?php $text_btn =  'TRANSFORMAR COTAÇÃO EM FACTURA'?>
					<button class="btn btn-dark d-flex justify-content-between f-w-600 text-uppercase"
							onclick="save_invoice_service('<?= base_url('quotation/save_quotation_service') ?>','<?=strtoupper($text_btn)?>','1')"
						<?= (($total > 0.0) && ($customer_id)) ? '' : 'disabled' ?>>
					<span>
						<span><i class="feather icon-save">&nbsp;</i></span>
						<?= $text_btn ?>
					</span>
					</button>
				<?php endif; ?>

				<?php $text_btn =  $this->lang->line(isset($is_edit) ? 'update' : 'save') . ' ' . $this->lang->line('quotation')?>
				<button class="btn btn-primary d-flex justify-content-between f-w-600 text-uppercase"
						onclick="save_invoice_service('<?= base_url('quotation/save_quotation_service') ?>','<?=strtoupper($text_btn)?>')"
					<?= (($total > 0.0) && ($customer_id)) ? '' : 'disabled' ?>>
					<span>
						<span><i class="feather icon-save">&nbsp;</i></span>
						<?=$text_btn ?>
					</span>
				</button>
			<?php endif; ?>
		</div>
	</div>
</div>


<script !src="">
    $(document).ready(function () {
        $('.number').on('input', function () {
            const id = $(this).data('id');
            const qty = $('#quantity-' + id).val();
            const price = $('#price-' + id).val();
            const total = parseFloat(price) * parseInt(qty);
            $('#total-' + id).val(total.toFixed(2));
        });

        $('.form-cart-item').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?=base_url('invoice/update_cart_service_item')?>",
                type: 'POST',
                data: $(this).serialize(),
                success: function (data) {
                    update_cart_service();
                }
            });
        })
    })
</script>
