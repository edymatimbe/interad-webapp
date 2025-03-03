<?php foreach ($result as $item): ?>
	<?php if ($item->id == $selected): ?>
		<option selected value="<?=$item->id?>"><?=$item->name?></option>
	<?php else: ?>
		<option value="<?=$item->id?>"><?=$item->name?></option>
	<?php endif; ?>
<?php endforeach; 
