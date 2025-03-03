<div class="card-header py-0 px-0">
	<div class="row">
		<div class="col-4 pl-4 pt-3">
			<h6 class="pl-3">
				<i class="feather icon-message-circle">&nbsp;</i>
				<?= $this->lang->line('sys_message') ?>
			</h6>
		</div>
		<div class="col-8">
			<nav>
				<div class="nav nav-tabs bg-gray-400 pt-2 px-2 rounded-top" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-success-tab" data-toggle="tab" href="#nav-success" role="tab"
					   aria-controls="nav-success" aria-selected="true">Mensagem de sucesso</a>
					<a class="nav-item nav-link" id="nav-warning-tab" data-toggle="tab" href="#nav-warning" role="tab"
					   aria-controls="nav-error" aria-selected="false">Mensagem de aviso</a>
					<a class="nav-item nav-link" id="nav-error-tab" data-toggle="tab" href="#nav-error" role="tab"
					   aria-controls="nav-error" aria-selected="false">Mensagem de erro</a>
				</div>
			</nav>
		</div>
	</div>
</div>
<div class="card-body">
	<div class="tab-content pt-2">
		<div class="tab-pane fade show active" id="nav-success" role="tabpanel" aria-labelledby="nav-success-tab">
			<div class="row">
				<div class="col-4 form-group">
					<input type="text" placeholder="Exemplo da mensagem" id="input_message" class="form-control f-s-13">
				</div>
			</div>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="top-end">Top Right</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="top-start">Top Left</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="center">center</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="center-start">center-start</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="center-end">center-start</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="bottom">bottom</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="bottom-start">bottom-start</button>
			<button class="btn btn-sm btn-outline-primary btn-ss" data-position="bottom-end">bottom-end</button>
		</div>
		<div class="tab-pane fade" id="nav-warning" role="tabpanel" aria-labelledby="nav-warning-tab">
			<div class="row">
				<div class="col-4 form-group">
					<input type="text" placeholder="Exemplo da mensagem" id="input_message_warning" class="form-control f-s-13">
				</div>
			</div>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="top-end">Top Right</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="top-start">Top Left</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="center">center</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="center-start">center-start</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="center-end">center-start</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="bottom">bottom</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="bottom-start">bottom-start</button>
			<button class="btn btn-sm btn-outline-warning btn-wrg" data-position="bottom-end">bottom-end</button>
		</div>
		<div class="tab-pane fade" id="nav-error" role="tabpanel" aria-labelledby="nav-error-tab">
			<div class="row">
				<div class="col-4 form-group">
					<input type="text" placeholder="Exemplo da mensagem" id="input_message_error" class="form-control f-s-13">
				</div>
			</div>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="top-end">Top Right</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="top-start">Top Left</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="center">center</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="center-start">center-start</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="center-end">center-start</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="bottom">bottom</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="bottom-start">bottom-start</button>
			<button class="btn btn-sm btn-outline-danger btn-error" data-position="bottom-end">bottom-end</button>
		</div>
	</div>
</div>

<script>

	$('.btn-ss').on('click', function () {
		const position = $(this).data('position');
		const message = $('#input_message').val() ? $('#input_message').val() : 'Mensagem de sucesso!'
		setMessage(position, 'success', message)
	})
	$('.btn-wrg').on('click', function () {
		const position = $(this).data('position');
		const message = $('#input_message_warning').val() ? $('#input_message_warning').val() : 'Mensagem de aviso!'
		setMessage(position, 'warning', message)
	})
	$('.btn-error').on('click', function () {
		const position = $(this).data('position');
		const message = $('#input_message_error').val() ? $('#input_message_error').val() : 'Mensagem de erro!'
		setMessage(position, 'error', message)
	})

	function setMessage(position, icon, message) {
		const Toast_c = Swal.mixin({
			toast: true,
			position: position,
			showConfirmButton: false,
			timer: 3000,
			// timerProgressBar: false
		})

		Toast_c.fire({
			icon: icon,
			title: message
		})

		$.ajax({
			url: '<?=base_url('settings/updateColumn')?>',
			type: 'POST',
			data: {column:'message_'+icon,value:position},
			success: function (data) {
				console.log(data)
			}
		});
	}
</script>
