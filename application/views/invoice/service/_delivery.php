<form id="form-delivery-details" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata">
				<i class="fas fa-truck-loading">&nbsp; </i> <?= 'Detalhes da factura ' ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="merchandise_type"><?= 'Tipo de Mercadoria' ?>
											<span class="text-danger"> &nbsp;*</span></label>
										<input type="text" class="form-control" id="merchandise_type"
											   name="merchandise_type"
											   value="<?= isset($delivery) ? $delivery['merchandise_type'] : '' ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="supplier">Fornecedor</label>
										<input type="text" class="form-control" id="supplier" name="supplier"
											   value="<?= isset($delivery) ? $delivery['supplier'] : '' ?>" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="regime"><?= 'Regime' ?></label>
										<input type="text" class="form-control" id="regime" name="regime"
											   value="<?= isset($delivery) ? $delivery['regime'] : '' ?>">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="transport"><?= 'Transporte:' ?>
										</label>
										<input type="text" class="form-control" id="transport" name="transport"
											   value="<?= isset($delivery) ? $delivery['transport'] : '' ?>">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="contact">Contacto</label>
										<input type="text" class="form-control" id="contact" name="contact"
											   value="<?= isset($delivery) ? $delivery['contact'] : '' ?>">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="other_reference"><?= 'Outras Referências' ?>
										</label>
										<input type="text" class="form-control" id="other_reference"
											   name="other_reference"
											   value="<?= isset($delivery) ? $delivery['other_reference'] : '' ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="invoice_number">Numero da factura</label>
										<input type="text" class="form-control" id="invoice_number"
											   name="invoice_number"
											   value="<?= isset($delivery) ? $delivery['invoice_number'] : '' ?>">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="waybill"><?= 'Air/Waybill:' ?>
										</label>
										<input type="text" class="form-control" id="waybill" name="waybill"
											   value="<?= isset($delivery) ? $delivery['waybill'] : '' ?>">
									</div>
								</div>


								<div class="col-md-4">
									<div class="form-group">
										<label for="arrival_date"><?= 'Data da Chegada' ?></label>
										<input type="date" class="form-control" id="arrival_date" name="arrival_date"
											   value="<?= isset($delivery) ? $delivery['arrival_date'] : '' ?>">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="transport_doc"><?= 'Doc. Transporte' ?>
										</label>
										<input type="text" class="form-control" id="transport_doc" name="transport_doc"
											   value="<?= isset($delivery) ? $delivery['transport_doc'] : '' ?>">
									</div>
								</div>

								<div class="col-md-8">
									<div class="form-group">
										<label for="terminal"><?= 'Terminal' ?></label>
										<input type="text" class="form-control" id="terminal" name="terminal"
											   value="<?= isset($delivery) ? $delivery['terminal'] : '' ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="du"><?= 'DU' ?>
										</label>
										<input type="text" class="form-control" id="du" name="du"
											   value="<?= isset($delivery) ? $delivery['du'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="address">Endereço do fornecedor</label>
										<textarea name="address" class="form-control" id="address" cols="20"
												  rows="3"> <?= isset($delivery) ? $delivery['address'] : '' ?></textarea>
									</div>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 ">
									<fieldset class="alert alert-light border mt-lg-2 mb-3 pt-1">
										<legend class="f-s-13 mb-0">Contractos</legend>
										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label for="fret_insurance">Fret & Insurence (ME)</label>
													<input type="text" class="form-control cif_change"
														   id="fret_insurance" name="fret_insurance"
														   value="<?= isset($delivery) ? $delivery['fret_insurance'] : '' ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="fob">Valor FOB (ME)</label>
													<input type="text" class="form-control cif_change" id="fob"
														   name="fob"
														   value="<?= isset($delivery) ? $delivery['fob'] : '' ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="cif">Valor CIF (ME)</label>
													<input type="hidden" class="form-control" id="cif" name="cif"
														   value="<?= isset($delivery) ? $delivery['cif'] : 0 ?>">
													<div class="border text-center p-2 bg-light h5">
														<strong
															id="cif_show_me"><?= isset($delivery) ? number_format($delivery['cif'], 2) : number_format(0, 2) ?> </strong>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="currency"><?= 'Moeda' ?>
													</label>
													<select name="currency" id="currency" class="form-control">
														<option value="">Selecione</option>
														<?php foreach ($this->core_model->get_all('currency') as $item): ?>
															<option <?= isset($delivery) ? $delivery['currency'] == $item->iso ? 'selected' : '' : '' ?>
																value="<?= $item->iso ?>"><?= $item->name.' ( '.$item->iso.' )' ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exchange"><?= 'Câmbio' ?>
													</label>
													<input type="text" class="form-control cif_change exchange"
														   id="exchange" name="exchange"
														   value="<?= isset($delivery) ? $delivery['exchange'] : '' ?>">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label for="cif_mt"><?= 'Valor CIF(MT)' ?>
													</label>
													<input type="hidden" class="form-control bg-light" id="cif_mt"
														   name="cif_mt"
														   value="<?= isset($delivery) ? $delivery['cif_mt'] : 0 ?>"
														   readonly>
													<div class="border text-center p-2 bg-light h5">
														<strong
															id="cif_show"><?= isset($delivery) ? number_format($delivery['cif_mt'], 2) : number_format(0, 2) ?> </strong>
														<strong> MT</strong>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
					<i class="fa fa-arrow-left">&nbsp;</i><?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
				</button>
			</div>
		</div>
	</div>
</form>
<script>
    $(document).ready(function () {
        const formatToCurrency = amount => {
            return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
        };

        $(".cif_change").on('input', function () {
            let fob = parseFloat($('#fob').val());
            let fret_insurance = parseFloat($('#fret_insurance').val());
            if (!fob) {
                fob = 0
            }
            if (!fret_insurance) {
                fret_insurance = 0
            }

            $('#cif').val(fob + fret_insurance);
            $('#cif_show_me').text(formatToCurrency(fob + fret_insurance))

            const cif = parseFloat($('#cif').val());
            const exchange = parseFloat($('#exchange').val());
            if (exchange) {
                $('#cif_mt').val(cif * exchange);
                $('#cif_show').text(formatToCurrency(cif * exchange))
            } else {
                $('#cif_mt').val(0);
                $('#cif_show').text(formatToCurrency(0))
            }
        });
    });
</script>
