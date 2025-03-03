<?php foreach ($models as $model): ?>
	<tr>
		<td class="text-uppercase"><?= $model['name'] ?></td>
		<td class="text-center">
			<div class="switch switch-warning d-inline m-r-10">
				<input class="checkbox-user" type="checkbox"
					   id="create-switch-user-<?= $model['id'] . '-' . $user ?>"
					   data-action="create"
					   data-user="<?= $user ?>"
					   data-model="<?= $model['id'] ?>"
					<?= $this->core_model->is_user_role($model['id'] . '_create', $user) ? 'checked' : '' ?>
				>
				<label for="create-switch-user-<?= $model['id'] . '-' . $user ?>"
					   class="cr"></label>
			</div>
		</td>
		<td class="text-center">
			<div class="switch switch-warning d-inline m-r-10">
				<input class="checkbox-user" type="checkbox"
					   id="read-switch-user-<?= $model['id'] . '-' . $user ?>"
					   data-action="read"
					   data-user="<?= $user ?>"
					   data-model="<?= $model['id'] ?>"
					<?= $this->core_model->is_user_role($model['id'] . '_read', $user) ? 'checked' : '' ?>
				>
				<label for="read-switch-user-<?= $model['id'] . '-' . $user ?>"
					   class="cr"></label>
			</div>
		</td>
		<td class="text-center">
			<div class="switch switch-warning d-inline m-r-10">
				<input class="checkbox-user" type="checkbox"
					   id="update-switch-user-<?= $model['id'] . '-' . $user ?>"
					   data-action="update"
					   data-user="<?= $user ?>"
					   data-model="<?= $model['id'] ?>"
					<?= $this->core_model->is_user_role($model['id'] . '_update', $user) ? 'checked' : '' ?>
				>
				<label for="update-switch-user-<?= $model['id'] . '-' . $user ?>"
					   class="cr"></label>
			</div>
		</td>
		<td class="text-center">
			<div class="switch switch-warning d-inline m-r-10">
				<input class="checkbox-user" type="checkbox"
					   id="delete-switch-user-<?= $model['id'] . '-' . $user ?>"
					   data-action="delete"
					   data-user="<?= $user ?>"
					   data-model="<?= $model['id'] ?>"
					<?= $this->core_model->is_user_role($model['id'] . '_delete', $user) ? 'checked' : '' ?>
				>
				<label for="delete-switch-user-<?= $model['id'] . '-' . $user ?>"
					   class="cr"></label>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
