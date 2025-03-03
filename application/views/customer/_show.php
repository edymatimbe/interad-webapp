<style>
	.select2-container--default .select2-selection--single {
		border: 1px solid #d1d3e2;
		border-radius: 3px;
		outline: none;
		height: 38px;
		padding-top: 5px;
		padding-left: 30px;
	}

	.select2-container--default .select2-search--dropdown .select2-search__field {
		outline: none;
	}
</style>

<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title text-agata"><i class="feather icon-user">&nbsp;</i> <?= $customer->name ?></h5>
	</div>
	<div class="modal-body bg-gray-200">
		<div class="row">
			<div class="col-lg-5">
				<div class="card">
					<div class="card-body pt-0">
						<div class="d-flex flex-column align-items-center text-center mb-4 pt-3">

							<?php if ($customer->image): ?>
								<?php if (is_file(FCPATH . $customer->image)): ?>
									<img class="shadow-sm img-radius"
										 src="<?= base_url($customer->image) ?>" alt="image"
										 title="" id="image_customer" width="120">
								<?php else: ?>
									<img class="img-radius shadow-sm"
										 src="<?= base_url(); ?>public/img/avatar/avatar.svg"
										 alt="image" width="120">
								<?php endif; ?>
							<?php else: ?>
								<img class="img-radius shadow-sm" src="<?= base_url(); ?>public/img/avatar/avatar.svg"
									 alt="image"
									 width="120">
							<?php endif; ?>

							<div class="mt-3">
								<h5 class="mb-2"><?= $customer->name ?></h5>

								<p class="text-secondary mb-1 f-s-14"><?= $customer->email ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-s-13">Nuit</h6>
							</div>

							<div class="col-sm-9 text-lg-right">
								<?= $customer->nuit ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-5">
								<h6 class="mb-0 f-s-13"><?= $this->lang->line('phone') ?></h6>
							</div>

							<div class="col-sm-7 text-lg-right">
								<?= $customer->phone ?>
							</div>
						</div>
						<hr>
						<?php if (!empty($customer->phone2) && $customer->phone2 != $customer->phone): ?>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0 f-s-13"><?= $this->lang->line('phone_alternative') ?></h6>
								</div>

								<div class="col-sm-9 text-lg-right">
									<?= $customer->phone2 ?>
								</div>
							</div>
							<hr>
						<?php endif; ?>
						<div class="row">
							<div class="col-sm-4">
								<h6 class="mb-0 f-s-13"><?= $this->lang->line('address') ?></h6>
							</div>

							<div class="col-sm-8 text-lg-right">
								<?= $customer->address ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-s-13"><?= $this->lang->line('city') ?></h6>
							</div>

							<div class="col-sm-9 text-lg-right">
								<?= $customer->city ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-s-13">Email</h6>
							</div>

							<div class="col-sm-9 text-lg-right">
								<?= $customer->email ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-s-13 text-capitalize"><?= $this->lang->line('group') ?></h6>
							</div>

							<div class="col-sm-9 text-lg-right">
								<?= $customer->group ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-5">
								<h6 class="mb-0 f-s-13"><?= $this->lang->line('customer_type') ?></h6>
							</div>

							<div class="col-sm-7 text-lg-right text-capitalize">
								<?= $customer->type=='empresa'? $this->lang->line('company') : $this->lang->line('Singular') ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-5">
								<h6 class="mb-0 f-s-13">Cliente a credito</h6>
							</div>

							<div class="col-sm-7 text-lg-right">
								<?= $customer->credit == 1 ?  $this->lang->line('yes') :  $this->lang->line('no') ?>
							</div>
						</div>

						<?php if ($customer->credit == 1): ?>
							<hr>
						<div class="row">
							<div class="col-sm-5">
								<h6 class="mb-0 f-s-13"><?= $this->lang->line('Payment_period')?></h6>
							</div>

							<div class="col-sm-7 text-lg-right text-capitalize">
								<?= $customer->period_pay. ' '.$this->lang->line('days') ?>
							</div>
						</div>
						<?php endif; ?>
						<hr>
					</div>
				</div>
			</div>
			<div class="col-lg-7">

				<h6 class="f-s-14 text-gray-600 f-w-600  bg-white rounded shadow-sm p-3">
					<i class="feather icon-list mr-2">&nbsp;</i>
					<?= $this->lang->line('sale_history') ?>
				</h6>
				<hr>
				<nav class="d-flex justify-content-center">
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-link active py-3" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
						   aria-controls="nav-home" aria-selected="true">
							<?= $this->lang->line('vds') ?>
						</a>
						<a class="nav-link py-3" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
						   aria-controls="nav-profile" aria-selected="false">
							<?= $this->lang->line('vcs') ?>
						</a>
						<a class="nav-link py-3" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
						   aria-controls="nav-contact" aria-selected="false">
							<?= $this->lang->line('quotations') ?>
						</a>
					</div>
				</nav>
				<div class="tab-content bg-white px-3 pt-3 rounded-bottom">
					<div class="tab-pane fade show active" id="nav-home">
						<div class="row">
							<div class="col-12">
								<ul class="list-group">
									<li class="list-group-item  d-flex justify-content-between align-items-center ">
										Vendas <strong class="text-secondary"><?= count($sales) ?></strong>
									</li>
									<li class="list-group-item  d-flex justify-content-between align-items-center ">
										Total pago <strong
											class="text-secondary"><?= number_format($total_amount_sales, 2) . ' MT' ?></strong>
									</li>

								</ul>
							</div>
						</div>
						<hr>
						<div class="table-responsive">
							<table class="table table-bordered table-small" id="table-sale">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-capitalize"><?= $this->lang->line('date') ?></th>
									<th class=""><?= $this->lang->line('amount') ?></th>
								</tr>
								</thead>
								<tbody>
								<?php $counter = 1; ?>
								<?php foreach ($sales as $sale): ?>
									<tr>
										<td class="text-center"><?= $counter ?></td>
										<td><?= date_format(date_create($sale->created_at), 'd-m-Y H:i:s') ?></td>
										<td><?= number_format($this->sale_model->get_one($sale->id)[0]->amount, 2) . ' MT' ?></td>
									</tr>
									<?php $counter += 1; ?>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="nav-profile">
						<div class="row">
							<div class="col-12">
								<ul class="list-group">
									<li class="list-group-item  d-flex justify-content-between align-items-center ">
										<?= $this->lang->line('Invoices') ?> <strong class="text-secondary"><?= count($invoices) ?></strong>
									</li>
									<li class="list-group-item  d-flex justify-content-between align-items-center">
										<?= $this->lang->line('Invoices').' '.$this->lang->line('Overdue') ?><strong class="text-danger"><?= $expired_invoices ?></strong>
									</li>
									<li class="list-group-item  d-flex justify-content-between align-items-center">
										<?= $this->lang->line('Invoices').' '.$this->lang->line('Pendents') ?><strong class="text-warning"><?= $pending_invoices ?></strong>
									</li>
									<li class="list-group-item  d-flex justify-content-between align-items-center">
										<?= $this->lang->line('Invoices').' '.$this->lang->line('Paid') ?><strong class="text-success"><?= $paid_invoices ?></strong>
									</li>
								</ul>
								<hr>
								<ul class="list-group">
									<li class="list-group-item ">
										<span class="f-w-600"><?= $this->lang->line('Value').' '.$this->lang->line('of2').' '.$this->lang->line('invoice') ?></span><span
											class="float-right cart-total"><?= number_format($invoice['total'], 2) ?> MT</span>
									</li>
									<li class="list-group-item text-success">
										<span class="f-w-600"><?= $this->lang->line('Total_paid') ?></span><span
											class="float-right cart-total"><?= number_format($invoice['totalPaid'], 2) ?> MT</span>
									</li>
									<li class="list-group-item text-danger">
										<span class="f-w-600"><?= $this->lang->line('Debt') ?></span><span
											class="float-right cart-total"><?= number_format($invoice['debt'], 2) ?> MT
										</span>
								</ul>
								<hr>
								<div class="table-responsive">
									<table class="table table-bordered mb-2" id="table-invoice">
										<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-capitalize"><?= $this->lang->line('Issue_date') ?></th>
											<th class="text-right"><?= $this->lang->line('Value').' '.$this->lang->line('of2').' '.$this->lang->line('invoice') ?></th>
											<th class="text-center"><?= $this->lang->line('status') ?></th>
										</tr>
										</thead>
										<tbody>
										<?php $counter = 1; ?>
										<?php foreach ($invoices as $invoice): ?>
											<tr>
												<td class="text-center"><?= $counter ?></td>
												<td><?= date_format(date_create($invoice->date), 'd-m-Y H:i:s') ?></td>
												<td class="text-right"><?= number_format($invoice->total, 2) . ' MT' ?></td>
												<td class="text-center">
													<?php if ($invoice->status == 'pendente'): ?>
														<span class="badge badge-warning p-2 wid-80"><?= $this->lang->line('Pendents') ?></span>
													<?php elseif ($invoice->status == 'paga'): ?>
														<span class="badge badge-success p-2 wid-80"><?= $this->lang->line('Paid') ?></span>
													<?php elseif ($invoice->status == 'vencido'): ?>
														<span class="badge badge-danger p-2 wid-80"><?= $this->lang->line('Overdue') ?></span>
													<?php endif; ?>
												</td>
											</tr>
											<?php $counter += 1; ?>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="nav-contact">
						<div class="row">
							<div class="col-12">
								<ul class="list-group">
									<li class="list-group-item  d-flex justify-content-between align-items-center ">
										<?= $this->lang->line('quotations') ?> <strong
											class="text-secondary"><?= count($quotations) ?></strong>
									</li>
									<li class="list-group-item  d-flex justify-content-between align-items-center ">
										Total
										<strong
											class="text-secondary"><?= number_format($total_total_quotations, 2) . ' MT' ?>
										</strong>
									</li>
								</ul>
							</div>
						</div>
						<hr>
						<div class="table-responsive">
							<table class="table table-bordered" id="table-quotation">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-capitalize"><?= $this->lang->line('date') ?></th>
									<th class="text-right"><?= 'Subtotal' ?></th>
									<th class="text-right"><?= 'Total' ?></th>
								</tr>
								</thead>
								<tbody>
								<?php $counter = 1; ?>
								<?php foreach ($quotations as $quotation): ?>
									<tr>
										<td class="text-center"><?= $counter ?></td>
										<td><?= date_format(date_create($quotation->created_at), 'd-m-Y H:i:s') ?></td>
										<td class="text-right"><?= number_format($quotation->subtotal, 2) . ' MT' ?></td>
										<td class="text-right"><?= number_format($quotation->total, 2) . ' MT' ?></td>
									</tr>
									<?php $counter += 1; ?>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="d-flex justify-content-between w-100">
			<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
				<i class="fa fa-arrow-left">&nbsp;</i>Cancel
			</button>
			<button class="btn btn-sm btn-outline-secondary"
					onclick="edit_customer(<?= $customer->id ?>)"><i
					class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
			</button>
		</div>
	</div>
</div>
<script !src="">
    $(document).ready(function () {
        // $('.selectpicker').selectpicker()
        $('#select-sale-type').select2({
            minimumResultsForSearch: -1,
        });
        initDataTable('table-sale', '', 5);
        initDataTable('table-invoice', '', 5);
        initDataTable('table-quotation', '', 5)
    })
</script>
