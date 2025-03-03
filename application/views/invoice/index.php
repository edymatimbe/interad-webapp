<?php $this->load->view('layout/header') ?>


<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white py-2 rounded">
		<div class="col-6 mb-lg-0 pt-2">
			<i class="feather icon-users text-agata border-right pr-2"></i>
			<label for=""><?= $this->lang->line('menu_customer') ?></label>
		</div>
		<div class="col-6">

		</div>
	</div>
</div>

<div class="card shadow mb-4" data-aos="fade-down" data-aos-delay="200">
	<div class="card-body">
		<div class="row">
			<div class="col-md-3 form-group">

				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text bg-white border-right-0 rounded-left"><i class="fa fa-search"></i>
						</div>
					</div>
					<input type="text" class="form-control border-left-0" style="" id="my-search" autocomplete="off" placeholder="<?= $this->lang->line('search') ?>">
				</div>
			</div>
			<div class="col-md-3 form-group">
				<div id="select-date" class="form-control w-100 cursor-pointer d-flex justify-content-between px-2">
					<div class="">
						<i class="feather icon-calendar"></i>&nbsp;
					</div>
					<span><?= 'Ultimos 30 dias' ?></span>
					<i class="fa fa-caret-down mt-1"></i>
				</div>
			</div>
			<div class="col-md-3 form-group">
				<div class="position-relative">
					<select id="select-status" class="select2-no-search w-100">
						<option value=""> <?= $this->lang->line('status') . ' ' . $this->lang->line('of2') . ' ' . $this->lang->line('invoice')  ?></option>
						<option value="pendente"><?= $this->lang->line('Pendents') ?></option>
						<option value="pago"><?= $this->lang->line('Paid') ?></option>
						<option value="vencida"><?= $this->lang->line('Overdue') ?></option>
					</select>

					<i class="feather icon-info position-absolute border-right pr-2" style="left: 10px; top: 13px"></i>
				</div>
			</div>
			<!-- $this->ion_auth->get_users_groups($user->id)->result()[0]->id -->
			<div class="col-md-3">
				<div class="position-relative">
					<select id="select-customer" class="form-control rounded">
						<option value=""><?= $this->lang->line('select') . ' ' . $this->lang->line('customer') ?></option>
						<?php foreach (users_groups(['groups.id' => 3, 'users.active' => 1]) as $customer) : ?>
							<option value="<?= $customer->user_id ?>"><?= $customer->name ?></option>
						<?php endforeach; ?>
					</select>
					<i class="feather icon-user position-absolute border-right pr-2" style="left: 10px; top: 13px"></i>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered data-table" id="table-history">
				<thead>
					<tr class="text-nowrap">
						<th style="width: 5%" class="text-center">#</th>
						<th style="width: 10%" class=""> <?= $this->lang->line('number') . ' ' . $this->lang->line('of2') . ' ' . $this->lang->line('invoice')  ?></th>
						<th style="width: 15%" class="text-capitalize"><?= $this->lang->line('customer') ?></th>
						<th style="width: 15%" class="text-capitalize"><?= 'Nome da camp.' ?></th>
						<th style="width: 10%" class="text-right">Subtotal</th>
						<th style="width: 10%" class="text-right">Total</th>
						<th style="width: 10%" class="text-right"><?= $this->lang->line('Total_paid') ?></th>
						<th style="width: 10%" class="text-right"><?= $this->lang->line('Debt') ?></th>
						<th style="width: 10%" class="text-center"><?= $this->lang->line('status') ?></th>
						<th style="width: 10%" class="text-center no-sort"><?= $this->lang->line('actions') ?></th>
					</tr>
				</thead>
				<tbody id="body-invoice">
					<?php $this->load->view('invoice/_table', array('invoices' => $invoices)) ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->load->view('layout/footer') ?>

<script>
	let target = '';
	let firstDate = moment().subtract(29, 'days').format('YYYY-MM-DD');
	let lastDate = moment().format('YYYY-MM-DD');


	$(document).ready(function() {
	
		$("#select-customer").select2({
			"language": {
				"noResults": function() {
					return "Sem resultado encontrado";
				}
			}
		}).on('select2:select', function(e) {
			filter_payments()
		});


		$("#select-status").select2({
			"language": {
				"noResults": function() {
					return "Sem resultado encontrado";
				}
			}
		}).on('select2:select', function(e) {
			filter_payments()
		});



		$('#select-date').daterangepicker({
			ranges: {
				'Hoje': [moment(), moment()],
				'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Últimos 7 Dias ': [moment().subtract(6, 'days'), moment()],
				'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
				'Este mês': [moment().startOf('month'), moment().endOf('month')],
				'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			showDropdowns: true,
			startDate: moment(),
			endDate: moment(),
			locale: {
				applyLabel: "Aplicar",
				cancelLabel: 'Cancelar',
				startLabel: 'Date initiale',
				endLabel: 'Date limite',
				customRangeLabel: 'Customizar',
				daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
				monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				firstDay: 1
			}
		}, function(start, end, label) {

			firstDate = start.format('YYYY-MM-DD');
			lastDate = end.format('YYYY-MM-DD');
			$('#select-date span').html(label);
			filter_payments()
		});

		function filter_payments() {

			$.ajax({
				url: '<?= base_url('invoice/filter') ?>',
				type: 'POST',
				data: {
					status: $("#select-status").val(),
					customer: $("#select-customer").val(),
				
					init_date: firstDate,
					final_date: lastDate

				},
				beforeSend: function() {
					show_loader();
				},
				success: function(data) {
					close_loader();

					// reDrawTable(data)
					$("#body-invoice").html(data)
					console.log(data)

				},
				error: function() {
					close_loader()
				}
			});


		}
	});



	$(document).ready(function() {
		initDataTable('table-history')
	});

	function get_payment_receipt(id, target) {
		$.ajax({
			url: '<?= base_url('payment/getReceipt') ?>',
			type: 'POST',
			data: {
				id: id,
				target: target
			},
			beforeSend: function() {
				show_loader();
			},
			success: function(data) {
				close_loader();
				if (target === 'modal') {
					$('#modal-sm-2-content').html(data.modal);
					$('#modal-sm-2').modal('show')
				} else {
					printJS({
						printable: data.pdf,
						type: 'pdf',
						base64: true
					})
				}
			},
			error: function() {
				close_loader()
			}
		});
	}


	function getInvoice(id, target) {
		$.ajax({
			url: '<?= base_url('/invoice/get_invoice') ?>',
			type: 'POST',
			data: {
				id: id
			},
			beforeSend: function() {
				show_loader();
			},
			success: function(data) {
				close_loader();
				if (target === 'modal') {
					$('#modal-sm-2-content').html(data.modal);
					$('#modal-sm-2').modal('show')
				} else {
					printJS({
						printable: data.pdf,
						type: 'pdf',
						base64: true
					})
				}
			},
			error: function() {
				close_loader();
				show_toast_error('error')
			}
		});
	}

	function getInvoice_note(id, target) {
		$.ajax({
			url: '<?= base_url('/invoice/get_invoice') ?>',
			type: 'POST',
			data: {
				id: id
			},
			beforeSend: function() {
				show_loader();
			},
			success: function(data) {
				close_loader();
				if (target === 'modal') {
					$('#modal-sm-2-content').html(data.modal);
					$('#modal-sm-2').modal('show')
				} else {
					printJS({
						printable: data.pdf,
						type: 'pdf',
						base64: true
					})
				}
			},
			error: function() {
				close_loader();
				show_toast_error('error')
			}
		});
	}



	function getNote(id, type) {
		$.ajax({
			url: baseURL + 'invoice/show_note',
			type: 'POST',
			data: {
				id: id
			},
			beforeSend: function() {
				show_loader();
			},
			success: function(data) {
				close_loader();
				console.log(type)

				if (type === 'modal') {
					$('#modal-sm-2-content').html(data.modal);
					$('#modal-sm-2').modal('show')
				} else {
					printJS({
						printable: data.pdf,
						type: 'pdf',
						base64: true
					})
				}
			},
			error: function() {
				close_loader();
				show_toast_error('error')
			}
		});
	}

	function getPayments(id) {
		$.ajax({
			url: '<?= base_url('/invoice/get_payments') ?>',
			type: 'POST',
			data: {
				id: id
			},
			beforeSend: function() {
				show_loader();
			},
			success: function(data) {
				close_loader();
				$('#modal-sm-2-content').html(data);
				$('#modal-sm-2').modal('show')
			},
		});
	}
</script>