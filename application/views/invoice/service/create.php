<?php $this->load->view('layout/header') ?>
<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white pt-3 rounded">
		<div class="col-md-3 mb-4 mb-lg-0 position-relative">
			<?php if (isset($is_edit)): ?>
				<select disabled class="border w-100 rounded bg-lights pl-4 select2-no-search" data-style="none"
						data-service="1">
					<option
						value="quotation" selected><?= $title ?>
					</option>
				</select>
				<i class="feather icon-edit text-agata position-absolute border-right pr-2"
				   style="left: 27px; top: 15px"></i>
			<?php else: ?>
				<select id="select-sale-type-new" class="border w-100 rounded bg-lights pl-4 select2-no-search"
						data-style="none" data-service="1">
					<option
						value="invoice" <?= $source == 'invoice' ? 'selected' : '' ?>><?= 'Factura de serviço' ?></option>

					<option
						value="quotation" <?= $source == 'quotation' ? 'selected' : '' ?>><?= 'Cotação de serviço' ?>
					</option>
				</select>
				<i class="feather icon-shopping-cart text-agata position-absolute border-right pr-2"
				   style="left: 27px; top: 15px"></i>
			<?php endif; ?>
		</div>

		<div class="col-md-2 mb-2 mb-lg-0">
			<div class="inputBox no-icon">
				<input id="issued_at" type="date" class="form-control dates" data-target="issued_at"
					   value="<?= $issued_at ?>">
				<label for="issued_at">Data de emissão</label>
			</div>
		</div>

		<div class="col-md-7">
			<div class="row">
				<div class="col-md-3 mb-2 mb-lg-0">
					<div class="inputBox no-icon">
						<input id="expiry_date" type="date" class="form-control dates" data-target="expiry_date"
							   value="<?= $expiry_date ?>">
						<label for="expiry_date">Data de vencimento</label>
					</div>
				</div>
				<div class="col-md-4 mb-4 mb-lg-0 ">
					<button onclick="delivery_details()" class="btn btn-block btn-outline-secondary py-2 d-none">
						<i class="feather icon-list mr-2"> </i> Detalhes da factura
					</button>
				</div>
				<div class="col-md-5 d-flex mb-4 mb-lg-0">
					<div style="width: 90%" class="position-relative">
						<select style="width: 100%" id="select-customer" class="f-s-8 pl-5 select_customers">
							<?php $this->load->view('invoice/service/_customerSelect', array('customer_id' => $customer_id)) ?>
						</select>
						<i class="feather icon-user position-absolute border-right pr-2"
						   style="left: 10px; top: 13px"></i>
					</div>
					<div class="ml-3">
						<button title="Add customer" onclick="add_customer()"
								class="btn btn-sm btn-secondary text-nowrap text-capitalize py-2">
							<i class="feather icon-user-plus">&nbsp;</i><?= $this->lang->line('new') ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header mb-0 pl-3 bg-white">
				<h6 class="card-title mt-2 f-s-15 mb-2 text-agata"><i
						class="fas fa-tags mr-2"></i><?= $this->lang->line('services') ?></h6>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive" id="div-table" style="overflow-x: auto; overflow-y: auto">
					<table class="table table- table-hover" id="table-service">
						<thead>
						<tr class="">
							<th scope="col" class="text-capitalize"><?= $this->lang->line('description') ?></th>
							<th class="text-right" scope="col"><?= $this->lang->line('price') ?></th>
							<th scope="col"></th>
						</tr>
						</thead>
						<tbody>
						<?php $this->load->view('invoice/service/_services') ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-7">
		<div class="card">
			<div class="card-body pb-0" id="cart-service">
				<?php $this->load->view('invoice/service/_cart') ?>
			</div>
		</div>
	</div>
</div>

<script !src="">
    function add_item_service(id) {
        $.ajax({
            type: 'POST',
            data: { 
                'id': id
            },
            url: "<?= base_url('/invoice/add_item_service') ?>",
            dataType: "JSON",
            success: function (data) {
                update_cart_service()
            }
        });
    }

    function removeItemService(id) {
        $.ajax({
            type: 'POST',
            data: {'id': id, is_service: 1},
            dataType: "JSON",
            url: "<?= base_url('/invoice/remove_item_service') ?>",
            success: function (data) {
                update_cart_service();
            }
        });
    }

    function update_cart_service() {
        $.ajax({
            type: 'GET',
            url: "<?=base_url('invoice/update_cart_service')?>",
            success: function (data) {
                $('#cart-service').html(data.cart);
                $('#table-service tbody').html(data.services);
                setFullHeight('#list-selected-items', 15);
            }
        });
    }

    $(document).ready(function () {
        $('#menu-service').addClass('active pcoded-trigger');
        $('#menu-service .invoice').addClass('active');
        $('#menu-service .pcoded-submenu').css('display', 'block');
        $('#dropdown-new-invoice-service').addClass('d-none');
        setFullHeight('#div-table', -100);
    });

    $(document).on('click', '#btn-show-invoice-service', function () {
        var customer = $('#select-customer').val();
        $.ajax({
            type: 'GET',
            data: {customer: customer},
            url: "<?=base_url('invoice/show_invoice_service')?>",
            success: function (data) {
                $('#modal-sm-2-content').html(data);
                $('#modal-sm-2').modal();
            }
        });
    });

    function delivery_details() {
        $.ajax({
            url: "<?=base_url('invoice/get_delivery_details')?>",
            type: 'GET',
            success: function (data) {
                $('#modal-sm-2-content').html(data);
                $('#modal-sm-2').modal('show');
            },
        });
    }

    $(document).on('submit', '#form-delivery-details', function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('invoice/save_delivery_details')  ?>",
            type: 'POST',
            dataType: "JSON",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status.toString() === 'success') {
                    show_toast_success(data.message);
                    $('#modal-sm-2').modal('toggle')
                }
                if (data.status.toString() === 'error') {
                    alert(data.message)
                }
            },
            error: function (xhr, status, error) {
                show_toast_error('Error when try save bank account')
                console.log(JSON.stringify(error))
            }
        })
    });

    $(document).on('change', '.dates', function () {
        target = $(this).data('target');
        $.ajax({
            url: "<?=base_url('invoice/set_my_cookie')?>",
            type: 'POST',
            data: {target: target, value: $(this).val()}
        });
    });

    function save_invoice_service(url, text, to_invoice = '') {
        Swal.fire({
            title: "",
            text: text + " ?",
            icon: "question",
            confirmButtonColor: "#00a897",
            confirmButtonText: "<i class='feather icon-printer mr-2'></i>Sim",
            cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
            cancelButtonClass: 'bg-dark',
            showCancelButton: true,
        }).then(function (rs) {
            if (rs.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: url,
                    data: {to_invoice: to_invoice},
                    beforeSend: function () {
                        show_loader();
                    },
                    success: function (data) {
                        close_loader();
                        if (data.ok) {
                            printJS({
                                printable: data.b64Doc,
                                type: 'pdf',
                                base64: true
                            });
                            show_toast_success(data.message);

                            if(data.reload){
                                window.location.reload();
							}else{
                                $('#select-customer').val('').trigger('change');
                                update_cart_service();
							}
                        }
                    }, error: function () {
                        close_loader();
                        show_toast_error('erro ao tentar salvar factura')
                    }
                })
            }
        });
    }
</script>
<?php $this->load->view('layout/footer') ?>
