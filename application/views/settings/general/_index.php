

<div class="row">
	<div class="col-md-3">
		<!--		<div class="card">-->
		<div class="stickyside" id="topMenu">
			<div class="list-group">
				<a href="#account" class="list-group-item list-group-item-action active py-3">
					<i class="feather icon-settings">&nbsp;</i><?= $this->lang->line('account') ?>
				</a>
				<a href="#notification" class="list-group-item list-group-item-action  d-none">
					<i class="feather icon-bell">&nbsp;</i><?= $this->lang->line('notifications') ?>
				</a>
				<a href="#message" class="list-group-item list-group-item-action">
					<i class="feather icon-message-circle">&nbsp;</i><?= $this->lang->line('sys_message') ?>
				</a>
				<a href="#theme" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-image">&nbsp;</i><?= $this->lang->line('theme') ?>
				</a>
				<a href="#bank-account" class="list-group-item list-group-item-action">
					<i class="feather icon-image">&nbsp;</i><?= $this->lang->line('bank_accounts') ?>
				</a>
				<a href="#language" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-flag">&nbsp;</i> Variavel multiplicador				</a>
				<a href="#sale" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-shopping-cart">&nbsp;</i><?= $this->lang->line('sale_cart') ?>
				</a>
				<a href="#unit_measurement" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-filter">&nbsp;</i><?= $this->lang->line('unit_measurement') ?>
				</a>
			</div>
		</div>
		<!--		</div>-->
	</div>

	<div class="col-md-9">
		<div id="account" class="card shadow mb-4">
			<?php $this->load->view('settings/_account') ?>
		</div>
		<div id="notification" class="card shadow mb-4  d-none">
			<?php $this->load->view('settings/_notification') ?>
		</div>
		<div id="message" class="card shadow mb-4">
			<?php $this->load->view('settings/_message') ?>
		</div>
		<div id="theme" class="card shadow mb-4">
<!--			--><?php //$this->load->view('settings/_theme') ?>
		</div>
		<div id="bank-account" class="card shadow mb-4">
			<?php $this->load->view('settings/_bank') ?>
		</div>
		<div id="language" class="card shadow mb-4">
			<?php $this->load->view('settings/_language') ?>
		</div>
		<div id="sale" class="card shadow mb-4 d-none">
			<?php $this->load->view('settings/_sale') ?>
		</div>
		<div id="unit_measurement" class="card shadow mb-4 d-none">
			<?php $this->load->view('settings/_unit_measurement') ?>
		</div>
		<div class="h" style="height: 950px;"></div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#topMenu .list-group-item').addClass('py-3')
	})
</script>


<div class="modal fade" id="modal-image-company">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body bg-light p-lg-0">
				<div class="container-fluid" style="height: 490px">
					<h6 class="text-white text-center w-100 bg-dark-transparent-5 pt-sm-2 pb-sm-2 pr-sm-2"><i
							class="fa fa-photo"></i>&nbsp;Image
								class="fa fa-photo"></i>&nbsp;<?= $this->lang->line('image') ?>
						<label class="close text-danger" data-dismiss="modal">&times;</label>
					</h6>

					<div id="div-cropper-company" class="m-0"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
	cropImage(
		'image_company',
		'file_image_company',
		'image_data_company',
		'modal-image-company',
		'div-cropper-company',
		95
	)
})

$(document).on('submit', '#form-company', function (e) {
	e.preventDefault();
	$.ajax({
		url: "<?= base_url('company/save')?>",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			show_loader()
		},
		success: function (data) {
			close_loader();
			if (data.status.toString() === 'success') {
				// console.log('account: '+data.account)
				show_toast_success(data.message)
				$('#account').html(data.account)
			}
			if (data.status.toString() === 'error') {
				alert(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			close_loader();
			show_toast_error('Error when try save company');
		}
	})

});

$(document).on('click','#btn-change-image',function () {
	$('#image_company').trigger('click')
});



// let base64;
// let elementIframe;
// $(document).ready(function () {
// 	// $('#card-general a').addClass('py-3')
// 	// $('#card-general i').addClass('mr-3')
// 	// window.print();
// 	// alert()
// 	// $('#btnShow').on('click',function () {
// 	//
// 	// });
// 	// $.ajax({
// 	// 	type: 'GET',
// 	// 	url: 'getPDF',
// 	// 	success: function (data) {
// 	// 		console.log(data)
// 	// 		try {
// 	// 			// base64 = btoa(atob(data));
// 	//
// 	// 			// $('#dialog').html(data)
// 	// 			// printJS({
// 	// 			// 	printable: 'dialog',
// 	// 			// 	type: 'html',
// 	// 			// })
// 	// 			// $('#dialog').addClass('d-none')
// 	// 			// printJS({
// 	// 			// 	printable: data,
// 	// 			// 	type: 'pdf',
// 	// 			// 	base64: true
// 	// 			// })
// 	// 		} catch (err) {
// 	// 			console.log('error')
// 	// 		}
// 	// 	}, error: function () {
// 	// 		alert('error')
// 	// 	}
// 	// });

// 	// $("#card-general").stick_in_parent({
// 	// 	offset_top: 120
// 	// });
// });
// //

// const topMenu = $("#topMenu");

// topMenu.stick_in_parent({
// 	offset_top: 90
// });
// topMenu.find('a').click(function () {
// 	$('html, body').animate({
// 		scrollTop: $($(this).attr('href')).offset().top - 100
// 	}, 500);
// 	return false;
// });

// var lastId;
// // All list items
// var scrollItems = topMenu.find("a").map(function () {
// 	var item = $($(this).attr("href"));
// 	if (item.length) {
// 		return item;
// 	}
// });

// Bind to scroll
// $(window).scroll(function () {
// 	var fromTop = $(this).scrollTop() + topMenu.outerHeight() - 220;
// 	// Get id of current scroll item
// 	var cur = scrollItems.map(function () {
// 		if ($(this).offset().top < fromTop) {
// 			return this;
// 		}
// 	});
// 	// Get the id of the current element
// 	cur = cur[cur.length - 1];
// 	var id = cur && cur.length ? cur[0].id : "";
// 	if (lastId !== id) {
// 		lastId = id;
// 		// Set/remove active class
// 		topMenu.find("a").removeClass("active").filter("[href='#" + id + "']").addClass("active");
// 	}
// });

</script>
