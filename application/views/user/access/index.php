<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title mb-1 mt-1">
					<i class="fa fa-users text-funae pr-2"></i>
					<?=$this->lang->line('access_management_group')?>
				</h6>
			</div>
			<div class="card-body p-0">
				<div class="nav-tabs-left">
					<nav class="bg-gray-200 pl-2 rounded-bottom">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<?php $active = 'active' ?>
							<?php foreach ($groups as $group): ?>
								<a class="nav-item nav-link py-3 text-center <?= $active ?>" id="nav-<?= $group->id ?>-tab"
								   data-toggle="tab"
								   href="#tab-<?= $group->id ?>"><?= $group->description ?>
								</a>
								<?php $active = '' ?>
							<?php endforeach; ?>
						</div>
					</nav>
					<div class="tab-content rounded-bottom p-3 bg-white " id="nav-tabContent">
						<?php $active = 'show active' ?>
						<?php foreach ($groups as $group): ?>
							<div class="tab-pane fade <?= $active ?>" id="tab-<?= $group->id ?>">
								<table class="table table-hover table-striped">
									<thead>
									<tr>
										<th></th>
										<th class="text-center"><?= $this->lang->line('create') ?></th>
										<th class="text-center"><?= $this->lang->line('show') ?></th>
										<th class="text-center"><?= $this->lang->line('update') ?></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($models as $model): ?>
										<tr>
											<td class="<?=$model['capitalize']==true?'text-capitalize':''?>"><?= $model['name'] ?></td>
											<td class="text-center">
												<div class="switch switch-purple d-inline m-r-10">
													<input class="checkbox" type="checkbox"
														   id="create-switch-<?= $model['id'] . '-' . $group->id ?>"
														   data-action="create"
														   data-group="<?= $group->id ?>"
														   data-model="<?= $model['id'] ?>"
														<?= $this->core_model->is_role_group($model['id'] . '_create', $group->id) ? 'checked' : '' ?>
													>
													<label for="create-switch-<?= $model['id'] . '-' . $group->id ?>"
														   class="cr"></label>
												</div>
											</td>
											<td class="text-center">
												<div class="switch switch-purple d-inline m-r-10">
													<input class="checkbox" type="checkbox"
														   id="read-switch-<?= $model['id'] . '-' . $group->id ?>"
														   data-action="read"
														   data-group="<?= $group->id ?>"
														   data-model="<?= $model['id'] ?>"
														<?= $this->core_model->is_role_group($model['id'] . '_read', $group->id) ? 'checked' : '' ?>
													>
													<label for="read-switch-<?= $model['id'] . '-' . $group->id ?>"
														   class="cr"></label>
												</div>
											</td>
											<td class="text-center">
												<div class="switch switch-purple d-inline m-r-10">
													<input class="checkbox" type="checkbox"
														   id="update-switch-<?= $model['id'] . '-' . $group->id ?>"
														   data-action="update"
														   data-group="<?= $group->id ?>"
														   data-model="<?= $model['id'] ?>"
														<?= $this->core_model->is_role_group($model['id'] . '_update', $group->id) ? 'checked' : '' ?>
													>
													<label for="update-switch-<?= $model['id'] . '-' . $group->id ?>"
														   class="cr"></label>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<?php $active = '' ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="card d-none">
			<div class="card-header bg-gray-200">
				<h6 class="card-title mb-1 mt-1">
					<i class="fa fa-user text-funae pr-2"></i>
					Gestão de acesso a nivel de utilizador</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="inputBox form-group">
							<select id="select-user" class="">
								<option value="">Selecione</option>
								<?php foreach ($this->core_model->get_all('users', array('active'=>1,'id !='=>1), array('first_name', 'ASC')) as $user): ?>
									<option value="<?= $user->id ?>"><?= $user->first_name ?></option>
								<?php endforeach; ?>
							</select>
							<label for="select-user">Utilizador</label>
						</div>
					</div>
				</div>

				<table class="table table-hover table-striped" id="table-user-role">
					<thead>
					<tr>
						<th></th>
						<th class="text-center">Criar</th>
						<th class="text-center">Visualizar</th>
						<th class="text-center">Actualizar</th>
						<th class="text-center">Apagar</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header pb-0">
				<h6 class="card-title mb-0">
					<label class="pt-2 text-capitalize"><span class="feather icon-list mr-2"></span><?=$this->lang->line('profiles')?></label>
					<button title="Novo perfil" class="btn btn-dark btn-sm text-nowrap float-right mb-2" type="button"
							onclick="set_profile(0)">
						<i class="feather icon-plus">&nbsp;</i><?=$this->lang->line('new')?>
					</button>
				</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="table-profile">
					<thead>
					<tr>
						<th style="width: 90%"><?=$this->lang->line('name')?></th>
						<th style="width: 10%;"></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($groups as $item) : ?>
						<tr>
							<td><?= $item->name ?></td>
							<td>
								<a onclick="set_profile(<?= $item->id ?>)" title="Editar"
								   class="btn btn-sm btn-outline-secondary px-2">
									<i class="feather icon-edit"></i>
								</a>
								<a onclick="del_profile(<?= $item->id ?>)" title="Remover"
								   class="btn btn-sm btn-outline-secondary ml-2 px-2 d-none">
									<i class="fa fa-trash text-danger"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>

    $(document).on('change', '.checkbox', function () {
        const target = $(this).prop('checked') === true ? 1 : 0;
        const action = $(this).data('action');
        const group = $(this).data('group');
        const model = $(this).data('model');

        $.ajax({
            url: 'user/setRoleGroup',
            type: 'POST',
            data: {target: target, action: action, group: group, model: model},
            success: function (data) {
                console.log(data)
            },
        });
    });

    function set_profile(id) {
        $.ajax({
            url: "<?=base_url('user/set_profile')?>",
            type: 'POST',
            data: {'id': id},
            success: function (data) {
                $('#modal-small-content').html(data);
                $('#modal-small').modal({
                    show: true,
                })
            },
        });
    }

    function del_profile(id) {
        Swal.fire({
            title: "",
            text: "Apagar perfil",
            icon: "question",
            confirmButtonColor: "#F36E39",
            confirmButtonText: "<i class='feather icon-check mr-2'></i>Sim",
            cancelButtonText: "<i class='feather icon-x mr-2'></i>Não",
            cancelButtonClass: 'bg-dark',
            showCancelButton: true,
        }).then(function (rs) {
            if (rs.isConfirmed) {
                $.ajax({
                    url: "<?=base_url('user/del_profile')?>",
                    type: 'POST',
                    data: {'id': id},
                    success: function (data) {
                        $('#link-access').trigger('click');
                        show_toast_success(data.message);
						$('#link-access').trigger('click');
					},
                });
            }
        });
    }

    $(document).on('submit', '#form-profile', function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?=base_url('user/save_profile')?>",
            type: 'POST',
            dataType: "JSON",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status.toString() === 'success') {
                    show_toast_success(data.message);
                    $('#modal-small').modal('toggle');
                    $('#table-profile tbody').html(data.table);
                    $('#link-access').trigger('click');
                }

                if (data.status.toString() === 'error') {
                    show_toast_error(data.message)
                }
                if (data.status.toString() === 'error_validation') {
                    setErrorValidation(data)
                }
            },
            error: function (xhr, status, error) {
                show_toast_error('erro ao configurar o sistema')
            }
        })
    });

    //    by user

</script>

<script !src="">
	$(document).ready(function () {
		$('#select-user').select2({
            "language": {
                "noResults": function () {
                    return "Sem utilizadores";
                }
            }
		}).on('select2:select', function (e) {
			const id = e.params.data.id;
            $.ajax({
                url: 'user/get_user_role',
                type: 'POST',
                data: {'id': id},
                success: function (data) {
                    $('#table-user-role tbody').html(data);
                },
            });
        });
    });

    $(document).on('change', '.checkbox-user', function () {
        const target = $(this).prop('checked') === true ? 1 : 0;
        const action = $(this).data('action');
        const user = $(this).data('user');
        const model = $(this).data('model');

        $.ajax({
            url: 'user/setUserRole',
            type: 'POST',
            data: {target: target, action: action, user: user, model: model},
            success: function (data) {
                console.log(data)
            },
        });
    });
</script>
