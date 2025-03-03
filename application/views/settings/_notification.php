<div class="card-header py-0 px-0 rounded-top">
	<div class="row">
		<div class="col-4 pl-4 pt-3">
			<h6 class="pl-3">
				<i class="feather icon-settings">&nbsp;</i>
				<?= $this->lang->line('notifications') ?>
			</h6>
		</div>
		<div class="col-8">
			<nav>
				<div class="nav nav-tabs bg-gray-400 pt-2 px-2 rounded-top" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-product-tab" data-toggle="tab" href="#nav-product"
					   role="tab"
					   aria-controls="nav-product" aria-selected="true">Produto</a>
				</div>
			</nav>
		</div>
	</div>
</div>

<div class="card-body">
	<div class="tab-content pb-0 pt-2">
		<div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
			<div class="accordion" id="accordionExample">
				<div class="card shadow-none border rounded-bottom">
					<button type="button" class="btn btn-light border-0 f-w-800 text-left" data-toggle="collapse"
							data-target="#collapse-stock">
						Estoque minimo
					</button>
					<div id="collapse-stock" class="collapse show" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<select name="" id="stock-color" class="select2-color">
										<option value="primary">Azul</option>
										<option value="info">Azul do ceu</option>
										<option value="secondary">Cinza</option>
										<option value="success">Verde</option>
										<option value="danger">Vermelho</option>
									</select>
								</div>
								<div class="col-md-9 pt-1" id="">
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="stock-color" data-from="top" data-align="left"
											data-column="notification_stock_min">Top Left
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="stock-color" data-from="top" data-align="right"
											data-column="notification_stock_min">Top Right
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="stock-color" data-from="top" data-align="center"
											data-column="notification_stock_min">Top Center
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="stock-color" data-from="bottom" data-align="left"
											data-column="notification_stock_min">
										Bottom Left
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="stock-color" data-from="bottom" data-align="right"
											data-column="notification_stock_min">
										Bottom Right
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="stock-color" data-from="bottom" data-align="center"
											data-column="notification_stock_min">
										Bottom Center
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-0 shadow-none border">
					<button type="button" class="btn btn-light border-0 f-w-800 text-left" data-toggle="collapse"
							data-target="#collapse2">
						Prazo de validade
					</button>
					<div id="collapse2" class="collapse" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<select id="due-date" class="select2-color">
										<option value="primary">Azul</option>
										<option value="info">Azul do ceu</option>
										<option value="secondary">Cinza</option>
										<option value="success">Verde</option>
										<option value="danger">Vermelho</option>
									</select>
								</div>
								<div class="col-md-9 pt-1" id="">
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="due-date" data-from="top" data-align="left"
											data-column="notification_product_due_date">Top Left
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="due-date" data-from="top" data-align="right"
											data-column="notification_product_due_date">Top Right
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="due-date" data-from="top" data-align="center"
											data-column="notification_product_due_date">Top Center
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="due-date" data-from="bottom" data-align="left"
											data-column="notification_product_due_date">
										Bottom Left
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="due-date" data-from="bottom" data-align="right"
											data-column="notification_product_due_date">
										Bottom Right
									</button>
									<button class="btn btn-sm btn-outline-secondary btn-notification"
											data-type="due-date" data-from="bottom" data-align="center"
											data-column="notification_product_due_date">
										Bottom Center
									</button>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
        function notify(from, align, type, animIn, animOut) {
            $.notify({
                icon: 'feather icon-bell',
                title: '',
                message: 'Mensagem da notificação',
                url: ''
            }, {
                element: 'body',
                type: type,
                allow_dismiss: true,
                placement: {
                    from: from,
                    align: align
                },
                offset: {
                    x: 30,
                    y: 30
                },
                spacing: 10,
                z_index: 999999,
                delay: 2500,
                timer: 1000,
                url_target: '_blank',
                mouse_over: false,
                animate: {
                    enter: animIn,
                    exit: animOut
                },
                icon_type: 'class',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
            });
        };
        // [ notification-button ]
        $('.btn-notification').on('click', function (e) {
            e.preventDefault();
            const column = $(this).attr('data-column');
            const color = $('#' + $(this).data('type')).val();
            const from = $(this).attr('data-from');
            const align = $(this).attr('data-align');
            const animIn = $(this).attr('data-animation-in');
            const animOut = $(this).attr('data-animation-out');
            notify(from, align, color, animIn, animOut);
            const notifyJson = [{color:color,from:from,align:align,animIn:animIn,animOut:animOut}];
            $.ajax({
                url: '<?=base_url('settings/updateColumn')?>',
                type: 'POST',
                data: {column:column,notify:JSON.stringify(notifyJson)},
                success: function (data) {
                    console.log(data)
                }
            });
        });
    });

    $(document).ready(function () {
        $('.select2-color').select2({
            width: "100%",
            templateSelection: formatColor,
            templateResult: formatColor,
            minimumResultsForSearch: -1,
        }).addClass('pl-0');
        // updateSelect2NoSearch()
    });

    function formatColor(icon) {
        return $('<span class="border-right pr-2 mr-2"><label class="bg-' + $(icon.element).val() + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></span><span>' + icon.text + '</span>');
    }
</script>
