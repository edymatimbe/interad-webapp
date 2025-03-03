<?php $counter = 0;
foreach ($categories as $category): ?>
	<?php $parent = $this->core_model->get_by_id('category', array('id' => $category->parent_id));?>
	<tr class="text-nowrap">
		<td class="text-center"><?= $counter + 1 ?></td>
		<td>
			<?php if ($category->image): ?>
				<?php if (is_file(FCPATH . $category->image)): ?>
					<img id="image-<?= $category->id ?>" class="my-border-radius shadow-sm" width="40"
						 src="<?= base_url($category->image) ?>" alt="image">
				<?php else: ?>
					<img id="image-<?= $category->id ?>" class="my-border-radius shadow-sm" width="40"
						 src="<?= base_url('public/img/camera.png') ?>" alt="image">
				<?php endif; ?>
			<?php else: ?>
				<img id="image-<?= $category->id ?>" class="my-border-radius shadow-sm" width="40"
					 src="<?= base_url('public/img/camera.png') ?>" alt="image">
			<?php endif; ?>

			<span class="cursor-pointer text-agata pl-3 text-nowrap f-w-700" style="cursor: pointer"
				  onclick="show_category(<?= $category->id ?>)">
								<?= $category->name ?>
							</span>
		</td>
		<td>
			<?= ($parent) ? $parent->name : '' ?>
		</td>
		<?php if ($is_service == 1): ?>
			<td><?= $category->in_invoice == 1?'SIM':'NÃO' ?></td>
		<?php endif; ?>
		<td class="text-center align-middle">
			<span class="badge badge-info w-75 py-2">
				<?= count($this->core_model->get_all('product',array('category_id'=>$category->id))) ?>
			</span>
		</td>

		<td class="text-center">
			<?php if ($category->active == 1): ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $category->id ?>"
					   data-table="category">
			<?php else: ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $category->id ?>"
					   data-table="category">
			<?php endif ?>
		</td>
		<td class="text-center px-2">
			<a title="<?= $this->lang->line('show').' '.$this->lang->line('category') ?>"
			   class="btn btn-sm btn-outline-primary mr-2"
			   onclick="show_category(<?= $category->id ?>)">
				<i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
			</a>

			<a title="<?= $this->lang->line('edit').' '.$this->lang->line('category') ?>"
			   class="btn btn-sm btn-outline-secondary"
			   onclick="edit_category(<?= $category->id ?>)">
				<i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
			</a>
		</td>
	</tr>
	<?php $counter += 1; endforeach; ?>
