<?php $this->load->view('layout/header') ?>


<?php //$this->load->view('layout/navbar') ?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow">
		<li class="breadcrumb-item text-capitalize"><a href="<?= base_url('users') ?>"><i class="feather icon-users">&nbsp;</i><span><?= $title ?></span></a></li>
	</ol>
</nav>

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="row mb-lg-2 d-flex justify-content-between">
			<div class="col-md-4">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text border-right-0 bg-white rounded-left"><i class="fa fa-search"></i></div>
					</div>
					<input type="text" class="form-control border-left-0" id="my-search" autocomplete="off" placeholder="<?=$this->lang->line('search')?>">
				</div>
			</div>
			<div class="col-md-2">
				<button class="btn btn-dark float-right br-2 text-nowrap" type="button" onclick="add_user()">
					<i class="feather icon-plus">&nbsp;</i><?=$this->lang->line('add').' '.$this->lang->line('user')?>
				</button>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table data-table" id="table-user">
				<thead>
					<tr>
						<th class="text-center no-sort" style="width: 5%">#</th>
						<th style="width: 25%"><?=$this->lang->line('name')?></th>
						<th class="text-capitalize" style="width: 15%">Email</th>
						<th style="width: 15%" class="text-capitalize text-center"><?=$this->lang->line('status')?></th>
						<th style="width: 10%" class="text-left text-capitalize"><?=$this->lang->line('profile')?></th>
						<th style="width: 15%" class="text-center no-sort text-capitalize"><?=$this->lang->line('actions')?></th>
					</tr>
				</thead>

				<tbody>
					<?php $this->load->view('user/_table',array('users'=>$users))?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Delete Modal-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete user?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body text-center">Select "Delete" below if you are want delete user</div>
			<div class="modal-footer d-flex justify-content-between">
				<button class="btn btn-sm btn-outline-secondary" type="button" data-dismiss="modal">Cancel
				</button>
				<a class="btn btn-sm btn-outline-danger float-right" href="" id="link-delete"><i
						class="fa fa-trash-alt">&nbsp;</i>Delete</a>
			</div>
		</div>
	</div>
</div>

<div id="modal-user" class="modal fixed-left fade" tabindex="-1" role="dialog" data-backdrop="static">
	<button id="btn-close-modal" class="btn btn-lg bg-white position-absolute" data-dismiss="modal">
		<i class="fa fa-close"></i>
	</button>
	<div class="modal-dialog modal-dialog-aside" role="document" id="modal-user-content">
	</div>
</div>


<script>
	$('#menu-user').addClass('active pcoded-trigger');
	// $('#menu-management .products').addClass('active');
	$('#menu-user .pcoded-submenu').css('display', 'block');
    function delete_user(link) {
        document.getElementById('link-delete').href = link
    }
	let modalOpen = 0;


	$(document).ready(function () {
		initDataTable('table-user')
	})
	//begin new user
	function add_user() {
		$.ajax({
			url: 'user/create',
			type: 'GET',
			success: function (data) {
				$('#modal-sm-2-content').html(data);
				$('#modal-sm-2').modal('show');

				if (modalOpen === 0) {
					cropImage(
							'image_user',
							'file_image_user',
							'image_data_user',
							'modal-image',
							'div-cropper'
					);
					modalOpen = 1
				}
			},
		});
	}
	let from = '';
	function edit_user(id,source) {
		$.ajax({
			url: 'user/edit',
			type: 'POST',
			data: {'id': id,'from':source},
			success: function (data) {
				$('#modal-sm-2-content').html(data);
				$('#modal-sm-2').modal('show');
				updateSelect2NoSearch();
				if (modalOpen === 0) {
					cropImage(
							'image_user',
							'file_image_user',
							'image_data_user',
							'modal-image',
							'div-cropper'
					);
					modalOpen = 1
				}
			},
		});
		from = source;
	}

	function show_user(id) {
		$.ajax({
			url: 'user/show',
			type: 'POST',
			data: {'id': id},
			success: function (data) {
				$('#modal-sm-2-content').html(data);
				$('#modal-sm-2').modal('show');
				initDataTable('table-user-products',false,8)
			},
		});
	}
	function getAllData() {
		$.ajax({
			url: 'user/getAll',
			type: 'GET',
			success: function (data) {
				reDrawTable(data)
			},
		});
	}

	$(document).on('submit', '#form-user', function (e) {
		e.preventDefault();
		const data =  new FormData(this)
		data.append('from',from); // when update
		$.ajax({
			url: "user/save",
			type: 'POST',
			dataType: "JSON",
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				// $("#loader").show();
			},
			success: function (data) {
				console.log(data)
				if (data.status.toString() === 'success') {
					$('#modal-sm-2').modal('toggle')
					show_toast_success(data.message);
					if(from){ //if update
						if(from === 'index'){
							$('#link-users').trigger('click'); // if update form index
						}else{ //when update profile
							$('#div-profile-content').html(data.profile)
						}
					}else{
						$('#link-users').trigger('click'); // if update form index
					}
				}
				if(data.status.toString() === 'error_validation'){
					setErrorValidation(data)
				}
			},
			error: function (xhr, status, error) {
				Swal.fire({
					title: "",
					text: 'Error when try',
					icon: "error",
					timer: 6000
				});
			}
		})
	})
</script>
<?php $this->load->view('layout/footer') ?>
