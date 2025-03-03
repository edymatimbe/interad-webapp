<?php if ($services) : ?>
	<?php foreach ($services as $service) : ?>
		<tr class="accordion-toggle collapsed cursor-pointer">
			<td class="align-middle"><?= $service->name ?></td>
			<td class="text-right align-middle"><?= number_format($service->price, 2) ?></td>
			<td class="text-center">
				<button onclick="add_item_service(<?= $service->id ?>)"
						class="btn btn-sm btn-outline-agata">
					<i class="feather icon-plus"></i>
				</button>
			</td>
		</tr>
	<?php endforeach; ?>
<?php else: ?>
<tr>
	<td colspan="3" class="text-center text-warning">SEM SERVIÇOS</td>
</tr>
<?php endif; ?>
