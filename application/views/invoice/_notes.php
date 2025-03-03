<div class="card shadow mb-4" data-aos="fade-down" data-aos-delay="200">
	<div class="card-body">
		<div class="row">
			<div class="col-md-3 form-group">

				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text bg-white border-right-0 rounded-left"><i
								class="fa fa-search"></i>
						</div>
					</div>
					<input type="text" class="form-control border-left-0" style="" id="my-search"
						   autocomplete="off"
						   placeholder="<?= $this->lang->line('search') ?>">
				</div>
			</div>
			<div class="col-md-3 form-group">
				<div id="select-date"
					 class="form-control w-100 cursor-pointer d-flex justify-content-between px-2">
					<div class="">
						<i class="feather icon-calendar"></i>&nbsp;
					</div>
					<span><?= $this->lang->line('today') ?></span>
					<i class="fa fa-caret-down mt-1"></i>
				</div>
			</div>
			<div class="col-md-3 d-none">
				<div class="position-relative">
					<select id="select-customer" class="form-control rounded">
						<option
							value=""><?= $this->lang->line('select') . ' ' . $this->lang->line('customer') ?></option>
						<?php foreach ($this->core_model->get_all('customer') as $customer): ?>
							<option value="<?= $customer->id ?>"><?= $customer->name ?></option>
						<?php endforeach; ?>
					</select>
					<i class="feather icon-user position-absolute border-right pr-2"
					   style="left: 10px; top: 13px"></i>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered data-table" id="table-history">
				<thead>
				<tr class="text-nowrap">
					<th style="width: 5%" class="text-center">#</th>
					<th style="width: 10%" class=""> <?= "Número de nota"  ?></th>
					<th style="width: 10%" class=""> <?= "Referente a afctura"  ?></th>
					<th style="width: 10%" class=""> <?= "Tipo"  ?></th>
					<th style="width: 15%" class="text-capitalize"><?= $this->lang->line('customer') ?></th>
					<th style="width: 10%" class="text-right">Subtotal</th>
					<th style="width: 10%" class="text-right">Total</th>
					<th style="width: 10%" class="text-center"><?= $this->lang->line('Issue_date') ?></th>
					<th style="width: 10%" class="text-center no-sort"><?= $this->lang->line('actions') ?></th>
				</tr>
				</thead>
				<tbody>
				<?php $this->load->view('invoice/_table_note', array('notes' => $notes)) ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
        initDataTable('table-history')
    });
</script>
