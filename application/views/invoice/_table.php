<?php foreach ($invoices as $key => $bill) : ?>
	<?php $user = get_by_id('users', ['id' => $bill->user_id]) ?>
	<tr>
		<td class="sort-key text-center"><?= $key + 1 ?></td>
		<td class="text-center"><?= $bill->code ?></td>
		<td class="text-left"><?= $user->first_name . ' ' . $user->last_name ?></td>
		<td class="sort-name"><?= $bill->title ?></td>
		<td class="sort-price text-right"><?= number_format($bill->cost, 2) ?> Mt</td>
		<td class="sort-price text-right"><?= number_format($bill->cost * 0.16, 2) ?> Mt</td>
		<td class="sort-price text-right"><?= number_format($bill->cost + $bill->cost * 0.16, 2) ?> Mt</td>
		<td class="text-right ">

			<?= number_format(0, 2) ?> Mt
		</td>


		<td class="sort-status text-center">
			<?php if ($bill->status == 'pago') : ?>
				<span class="badge badge-success text-green btn-square w-100 "><?= $bill->status ?><i class="feather icon-check text-end"></i></span>
			<?php elseif ($bill->status == 'pendente') : ?>
				<span class="badge badge-warning text-yellow btn-square w-100"><?= $bill->status ?> <i class="feather icon-info"></i> </span>
			<?php else : ?>
				<span class="badge badge-danger  text-red btn-square w-100"><?= $bill->status ?> <i class="feather icon-video-off"></i></span>
			<?php endif; ?>

		</td>


		<td style="width: 10%" class="text-right text-nowrap">
			<?php $payment = get_by_id('payment', ['id' => $bill->controller_id]) ?>
			<?php if ($payment) : ?>
				<button onclick="get_payment_receipt(<?= $bill->controller_id ?>, 'modal')" title="<?= $this->lang->line('show') ?>" class="btn btn-sm btn-info mx-2">
					<i class="feather icon-list mr-2"></i><?= 'Recibo' ?>
				</button>
			<?php endif; ?>

			<button onclick="getInvoice(<?= $bill->controller_id ?>,'modal')" title="<?= $this->lang->line('show') ?>" class="btn btn-sm btn-outline-primary mx-2">
				<i class="feather icon-eye mr-2"></i><?= $this->lang->line('show') ?>
			</button>
			<button onclick="getInvoice(<?= $bill->controller_id ?>,'print')" title="<?= $this->lang->line('print') ?>" class="btn btn-sm btn-secondary d-none">
				<i class="feather icon-printer mr-2"></i><?= $this->lang->line('print') ?>
			</button>




		</td>
	</tr>
<?php endforeach; ?>