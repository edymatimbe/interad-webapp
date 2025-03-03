<style>
	#header {
		height: 180px;
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
</style>
<div class="modal-content text-dark">
	<div class="modal-header bg-gray-200">
		<h5 class="modal-title" id="modal-sale-title">
			<i class="fa fa-file-pdf text-danger">&nbsp;</i>
			<span class="text-agata">
				Ver <?= $this->lang->line('invoice') ?>
			</span>
		</h5>
		<?php if (!isset($is_receipt)) : ?>
			<?php if ($is_cart == 0) : ?>
				<?php if (isset($is_quotation)) : ?>
					<button class="btn btn-sm btn-outline-agata float-right" onclick="printQuotation(<?= $id ?>)">
						<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
					</button>

					<?php elseif (isset($is_note)) : ?>
						<button class="btn btn-sm btn-outline-agata float-right" onclick="getNote(<?= $id ?>,'print')">
						<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
					</button>
							
				<?php else : ?>
					<button class="btn btn-sm btn-outline-agata float-right" onclick="getInvoice(<?= $id ?>,'print')">
						<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
					</button>
				<?php endif; ?>
			<?php endif; ?>
		<?php else : ?>
			<button class="btn btn-sm btn-outline-agata float-right" onclick="get_payment_receipt(<?= $id ?>,'print')">
				<i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
			</button>
		<?php endif; ?>

	</div>
	<div class="modal-body px-5 pb-5" id="">
		<div id="header" class="border-bottom">
			<div class="float-left position-relative w-45">
				<p class="position-relative top-0">
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
				<div class="position-absolute" style="top: 60px">
					<p class="my-0"><strong><?= $company->name ?></strong></p>
					<?php if ($company->address) : ?>
						<p class="my-0"><?= $company->address ?></p>
					<?php endif; ?>
					<p class="my-0"><?= $company->city ?></p>
					<p class="my-0"><strong>Tel:</strong>
						<?= $company->phone ? ' ' . $company->phone : '' ?>
						<?= ($company->phone2) ? ' / ' . $company->phone2 : '' ?> </p>
					<?php if ($company->email) : ?>
						<p class="my-0"><strong>Email:</strong><?= $company->email ?></p>
					<?php endif; ?>
					<?php if ($company->nuit) : ?>
						<p class="my-0"><strong>Nuit:</strong><?= $company->nuit ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="float-left pt-3" style="width: 22%;">
			</div>
			<div class="float-right pt-3 position-relative" style="width: 33%;height: 80px;">
				<div class="position-absolute" style="width: 100%; height: 80px; right: 0; top: 60px">
					<p class="my-0 text-left"><?= 'Exmo.(s) Sr.(s)' ?></p>
					<p class="my-0 text-left">
						<Strong><?= isset($customer) ? $customer->name : 'Nome do cliente' ?></Strong>
					</p>
					<p class="my-0 text-left"><?= isset($customer) ? $customer->address : '### ## ### ####' ?></p>
					<p class="my-0 text-left">Tell: <?= isset($customer) ? $customer->phone : '### ## ### ####' ?></p>
					<p class="my-0 text-left">Nuit: <?= isset($customer) ? $customer->nuit : '#########' ?></p>
				</div>
			</div>
		</div>
		<br>
		<?php if (!isset($is_receipt)) : ?>

			<div class="border-bottom" style="height: 140px">
				<div class="float-left" style="width: 33.3%">
					<p class="my-0 text-left"><?= 'Tipo de Mercadoria : ' . (isset($delivery) ? $delivery['merchandise_type'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Regime : ' . (isset($delivery) ? $delivery['regime'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Transporte : ' . (isset($delivery) ? $delivery['transport'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Outras Referências : ' . (isset($delivery) ? $delivery['other_reference'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Air/Waybill : ' . (isset($delivery) ? $delivery['waybill'] : '') ?></p>
				</div>
				<div class="float-left" style="width: 33.3%">
					<p class="my-0 text-left"><?= 'Fornecedor : ' . (isset($delivery) ? $delivery['supplier'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Contacto : ' . (isset($delivery) ? $delivery['contact'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Endereço : ' . (isset($delivery) ? $delivery['address'] : '') ?></p>
					<p class="my-0 text-left"><?= 'N/Factura : ' . (isset($delivery) ? $delivery['invoice_number'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Valor FOB (ME) : ' . (isset($delivery) ? number_format($delivery['fob'], 2) : '') ?></p>
					<p class="my-0 text-left"><?= 'Fret & Insurence (ME) : ' . (isset($delivery) ? number_format($delivery['fret_insurance'], 2) : '') ?></p>
					<p class="my-0 text-left"><?= 'Valor CIF (ME) : ' . (isset($delivery) ? number_format($delivery['cif'], 2) : '') ?></p>
				</div>
				<?php $currency_name = '';
				$currency_code = '';
				if (isset($delivery)) : ?>
					<?php $currency = $this->core_model->get_by_id('currency', ['iso' => $delivery['currency']]) ?>
					<?php if ($currency) : ?>
						<?php $currency_name = $currency->name ?>
						<?php $currency_code = $currency->iso ?>
					<?php endif; ?>
				<?php endif; ?>
				<div class="float-left" style="width: 33.3%">
					<p class="my-0 text-left"><?= 'Data da Chegada : ' . (isset($delivery) ? $delivery['arrival_date'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Doc. Transporte : ' . (isset($delivery) ? $delivery['transport_doc'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Terminal : ' . (isset($delivery) ? $delivery['terminal'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Moeda: ' . ($currency_name ? $currency_name . ' (' . $currency_code . ')' : '') ?></p>
					<p class="my-0 text-left"><?= 'Câmbio : ' . (isset($delivery) ? $delivery['exchange'] : '') ?></p>
					<p class="my-0 text-left"><?= 'Valor CIF (MT) : ' . (isset($delivery) ? number_format($delivery['cif_mt'], 2) : '') ?> </p>
					<p class="my-0 text-left"><?= 'DU : ' . (isset($delivery) ? $delivery['du'] : '') ?></p>
				</div>
			</div>
		<?php endif; ?>
		<br>
		<?php if (!isset($is_receipt)) : ?>
			<div class="" style="height: 75px">
				<div class="float-left" style="width: 50%">

					<p class="my-0 text-left"><strong>Data
							Emissão: </strong><?= simple_date($issued_at) ?></p>
					<?php if (!isset($is_note)) : ?>

						<p class="my-0 text-left"><strong>Data de
								Vencimento: </strong><?= simple_date($expiry_date) ?></p>
						<p class="my-0 text-left"><strong>Prazo de
								Pagamento: </strong><?= ' Pronto pagamento' ?>
							<span class="float-right"></span>
						</p>
					<?php endif; ?>
				</div>
				<div class="float-left" style="width: 50%">
					<p>&nbsp;</p>
					<p class="text-right my-0"><strong><?= isset($object) ? $object : 'Factura' ?> Nº AL
							/ <?= $number . ' / ' . date('Y') ?> </strong></p>
					<p class="text-right my-0"><strong>Original</strong></p>
				</div>
			</div>
		<?php else : ?>
			<div class="" style="height: 170px;">
				<div class="float-left pr-3" style="width: 40%">
					<p class="my-1 text-left"><strong>Data: </strong><?= simple_date($issued_at) ?></p>
					<p class="my-2 text-left"><strong>Tipo de pagamento: </strong>
						<label class="float-right">
							<?php $parent = $this->sale_model->get_parent($payment->method_id); ?>
							<?= !empty($parent) ? $parent->name . ' | ' : '' ?>
							<?= $payment_method_name ?>
						</label>
					</p>
					<p class="my-2 text-left">
						<strong><?= $this->lang->line('Amount_paid') ?></strong>
						<label class="float-right">
							<?= number_format($payment->amount, 2) ?>
						</label>
					</p>

					<?php if ($payment->method_id == 1) : ?>
						<p class="my-1 text-left">
							<strong><?= $this->lang->line('amount_received') ?></strong>
							<label class="float-right">
								<?= number_format($payment->total_paid, 2) ?>
							</label>
						</p>
						<p class="my-2 text-left">
							<strong><?= $this->lang->line('change') ?></strong>
							<label class="float-right">
								<?= number_format($payment->change, 2) ?>
							</label>
						</p>
					<?php endif; ?>


					<?php if ($this->core_model->get_by_id('payment_method', array('id' => $payment->method_id))->parent_id == 4) : ?>
						<p class="my-1 text-left">
							<strong><?= 'Referência' ?></strong>
							<label class="float-right">
								<?= $payment->reference ?>
							</label>
						</p>
						<p class="my-2 text-left">
							<strong><?= 'Número de telefone' ?></strong>
							<label class="float-right">
								<?= $payment->mobile_number ?>
							</label>
						</p>
					<?php endif; ?>

					<?php if ($payment->method_id == 3) : ?>
						<p class="my-1 text-left">
							<strong><?= 'Banco' ?></strong>
							<label class="float-right">
								<?= $payment->check_bank ?>
							</label>
						</p>
						<p class="my-2 text-left">
							<strong><?= 'Número do cheque' ?></strong>
							<label class="float-right">
								<?= $payment->check_number ?>
							</label>
						</p>
						<p class="my-1 text-left">
							<strong><?= 'Número da conta' ?></strong>
							<label class="float-right">
								<?= $payment->account ?>
							</label>
						</p>
						<p class="my-1 text-left">
							<strong><?= 'Titular' ?></strong>
							<label class="float-right">
								<?= $payment->holder ?>
							</label>
						</p>
					<?php endif; ?>


					<?php if ($payment->method_id == 12) : ?>
						<p class="my-1 text-left">
							<strong><?= 'Banco' ?></strong>
							<label class="float-right">
								<?= $payment->check_bank ?>
							</label>
						</p>
						<?php if ($payment->account) : ?>
							<p class="my-2 text-left">
								<strong><?= 'Número da conta' ?></strong>
								<label class="float-right">
									<?= $payment->account ?>
								</label>
							</p>
						<?php endif; ?>
						<?php if ($payment->nib) : ?>
							<p class="my-1 text-left">
								<strong><?= 'NIB' ?></strong>
								<label class="float-right">
									<?= $payment->nib ?>
								</label>
							</p>
						<?php endif; ?>
						<p class="my-1 text-left">
							<strong><?= 'Titular' ?></strong>
							<label class="float-right">
								<?= $payment->holder ?>
							</label>
						</p>
					<?php endif; ?>
				</div>
				<div class="float-left pl-3" style="width: 60%">
					<p class="my-1">&nbsp;</p>
					<p class="my-1">&nbsp;</p>
					<p class="my-1">&nbsp;</p>
					<p class="my-1">&nbsp;</p>
					<p class="text-right my-0"><strong><?= 'Recibo' ?> Nº AL
							/ <?= $number . ' / ' . date('Y') ?> </strong></p>
					<p class="text-right my-0"><strong>Original</strong></p>
				</div>
			</div>
		<?php endif; ?>

		<br>
		<?php $in_full = $this->core_model->por_extenso(number_format($total, 2, ',', '')) ?>
		<?php $in_full = str_replace(',', ' e ', str_replace('um mil', 'Mil', $in_full)) ?>

		<?php if (!isset($is_receipt)) : ?>
			<table class="table table-small">
				<thead>
					<tr class="bg-light">
						<th class="border-top border-left bg-white" style="width: 25%"><?= $this->lang->line('description') ?>
						</th>
						<th class="border-top bg-white" style="width: 7.5%"> <?= 'Un' ?></th>
						<th class="border-top text-right bg-white" style="width: 7.5%"><?= 'Qtd' ?></th>
						<th class="border-top text-right bg-white" style="width: 15%"><?= 'Pr. Unit' ?></th>
						<th class="border-top text-right bg-white" style="width: 15%"><?= 'Iva %' ?></th>
						<th class="border-top text-right bg-white" style="width: 15%"><?= 'Desc.(%)' ?></th>
						<th class="border-top text-right bg-white border-right" style="width: 15%"><?= 'Valor (MT)' ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($is_cart == 1) : ?>
						<?php foreach ($this->cart_service->contents() as $item) : ?>
							<tr class="border-bottom-0">
								<td class="border-top-0"><?= $item['name'] ?></td>
								<td class="border-top-0"><?= 'un' ?></td>
								<td class="border-top-0 text-right"><?= number_format($item['qty'], 2) ?></td>
								<td class="border-top-0 text-right"><?= $this->cart_service->format_number($item['price']) ?></td>
								<td class="border-top-0 text-right"><?= $item['tax'] == 1 ? '17 %' : '' ?></td>
								<td class="border-top-0 text-right"><?= '' ?></td>
								<td class="border-top-0 text-right"><?= $this->cart_service->format_number($item['price'] * $item['qty']) ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<?php if (isset($has_quotation)) : ?>
							<tr>
								<td colspan="7">Cotação
									nº <?= $has_quotation->number . ' ' . simple_date($has_quotation->issued_at) ?></td>
							</tr>
						<?php endif; ?>
						<?php foreach ($items as $item) : ?>
							<?php if (isset($is_note)) : ?>
								<?php $price = $item->price  ?>
							<?php else : ?>
								<?php $price = $item->other_price ? $item->other_price : $item->price ?>
							<?php endif; ?>

							<tr class="border-bottom-0">
								<td class="border-top-0"><?= $item->name ?></td>
								<td class="border-top-0"><?= 'un' ?></td>
								<td class="border-top-0 text-right"><?= number_format($item->qty, 2) ?></td>
								<td class="border-top-0 text-right"><?= $this->cart_service->format_number($price) ?></td>
								<td class="border-top-0 text-right"><?= $item->tax == 1 ? tax().' %' : '' ?></td>
								<td class="border-top-0 text-right"><?= '' ?></td>
								<td class="border-top-0 text-right"><?= $this->cart_service->format_number($price * $item->qty) ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="border-top" style="height: 240px">
				<div class="float-left" style="width: 55%">
					<p class="text-center mb-0"><strong>Resumo do IVA</strong></p>
					<table class="table table-small">
						<thead>
							<tr class="bg-light">
								<th class="border-top border-left bg-white" style="width: 15%"><?= 'Taxa' ?></th>
								<th class="border-top bg-white text-right" style="width: 35%"> <?= 'Base de Incidência' ?></th>
								<th class="border-top text-right bg-white" style="width: 25%"><?= 'Valor' ?></th>
								<th class="border-top text-right bg-white border-right" style="width: 25%"><?= 'Motivo de Isenção' ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="border-top-0">Isento</td>
								<td class="border-top-0 text-right"><?= number_format($exempt_tax, 2) ?></td>
								<td class="border-top-0 text-right"><?= number_format(0, 2) ?></td>
								<td class="border-top-0">Isento Art. 9 do CIVA</td>
							</tr>
							<tr>
								<td class="border-top-0"><?= tax() ?> %</td>
								<td class="border-top-0 text-right"><?= number_format($pay_tax, 2) ?></td>
								<td class="border-top-0 text-right"><?= number_format($pay_tax * taxMath(), 2) ?></td>
								<td class="border-top-0"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="float-left pl-5" style="width: 45%">
					<p class="mb-0">&nbsp;</p>
					<?php foreach ($categories_sum as $item) : ?>
						<p class="my-0"><?= $item['name'] ?>: <span class="float-right"><?= number_format($item['value'], 2) ?></span></p>
					<?php endforeach; ?>
				</div>
				<div class="float-left" style="width: 55%">
					<div class="border p-2" style="height: 135px">
						<div class="float-left" style="width: 100%">
							<p>
								<strong>Por extenso</strong>
							</p>
						</div>

						<div class="float-left" style="width: 100%;">
							<p class="text-capitalize"><?= $in_full ?></p>
						</div>
					</div>
				</div>
				<div class="float-left pl-5" style="width: 45%">
					<div class="border">
						<table class="table table-small pb-0 mb-0">
							<tbody>
								<tr>
									<td class="border-top-0">Total antes de descontos</td>
									<td class="border-top-0 text-right"><?= number_format($subtotal, 2) ?></td>
								</tr>
								<tr>
									<td>Desconto Comercial</td>
									<td class="text-right"><?= number_format(0, 2) ?></td>
								</tr>
								<tr>
									<td>Desconto Financeiro</td>
									<td class="text-right"><?= number_format(0, 2) ?></td>
								</tr>
								<tr>
									<td>Base de Incidência de I.V.A</td>
									<td class="text-right"><?= number_format($pay_tax, 2) ?></td>
								</tr>
								<tr>
									<td>Total de I.V.A</td>
									<td class="text-right"><?= number_format($total_iva, 2) ?></td>
								</tr>
								<tr>
									<td>Total do documento</td>
									<td class="text-right"><?= number_format($total, 2) ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<br>
			<p>
				O pagamento pode ser feito por cheques, Depositos ou Transferência Bancária
			</p>
			<table class="table table-small">
				<thead>
					<tr class="bg-light">
						<th class="border-top border-left bg-white" style="width: 30%"><?= 'Banco' ?></th>
						<th class="border-top bg-white" style="width: 30%"> <?= 'Conta' ?></th>
						<th class="border-top text-left bg-white" style="width: 30%"><?= 'NIB' ?></th>
						<th class="border-top text-center bg-white border-right" style="width: 10%"><?= 'Moeda' ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($bank_accounts as $bank_account) : ?>
						<?php $bank = $this->core_model->get_by_id('bank', ['id' => $bank_account->bank_id]) ?>
						<tr>
							<td class="border-top-0"><?= $bank->name ?></td>
							<td class="border-top-0"><?= $bank_account->number ?></td>
							<td class="border-top-0"><?= $bank_account->nib ?></td>
							<td class="border-top-0 text-center"><strong><?= 'MT' ?></strong></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<br>
			<p>Processado por computador / Software licenciado</p>
		<?php else :; ?>
			<table id="table" class="table table-small">
				<thead>
					<tr class="bg-light">
						<th class="border-top border-left bg-white" style="width: 15%"><?= "Tipo de documento" ?>
						</th>
						<th class="border-top bg-white" style="width: 5%"> <?= 'Número' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Total' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Pendente' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Valor pago' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Remanescente' ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($invoices as $invoice) : ?>
						<tr>
							<td class="border-bottom border-right border-left text-center"><?= 'FACTURA' ?></td>
							<td class="border-bottom"><?= 'FT-' . $invoice->invoice_number ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format($invoice->invoice_total, 2) ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format($this->invoice_model->get_debt($invoice->invoice_id), 2) ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format($invoice->value, 2) ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format($this->invoice_model->get_debt($invoice->invoice_id), 2) ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<br>
			<p class="mb-2 border-top-separator">
				<strong>Total:</strong>
				<span class="float-right"><strong><?= number_format($total, 2) ?></strong></span>
			</p>
			<p class="my-0"><strong>Extenso:</strong></p>
			<p class="text-uppercase"><?= $in_full ?></p>
			<br>
			<br>
			<p class="text-center"><strong>_______________________________________________</strong></p>
			<p class="text-center"><strong>( Assinatura e carimbo )</strong></p>
		<?php endif; ?>
	</div>

	<div class="modal-footer bg-gray-200">
		<div class="d-flex justify-content-between w-100">
			<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
				<?= $this->lang->line('cancel') ?>
			</button>
		</div>
	</div>
</div>