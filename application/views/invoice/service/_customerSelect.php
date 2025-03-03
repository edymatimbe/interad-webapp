<option value=""><?= $this->lang->line('select') . ' ' . $this->lang->line('customer') ?></option>
<?php foreach ($customers as $customer): ?>
	<option <?= ($customer_id == $customer->id) ? 'selected' : '' ?>
		value="<?= $customer->id ?>"><?= $customer->name ?>
	</option>
<?php endforeach; ?>
