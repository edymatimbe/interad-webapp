<!DOCTYPE html>
<html>
<head>
	<title>Quotation</title>
	<link href="<?= base_url(); ?>public/css/quotation.css" rel="stylesheet">
</head>
<body>
<div id="header" class="mb-3">
	<div class="float-left" style="width: 35%;">
		<p>
			<img class="ml-n2" src="<?= base_url('public/img/logo.png') ?>"
				 width="220" alt="">
		</p>
	</div>
	<div class="float-left pt-4" style="width: 60%;">
		<p class="my-1">Av. Amilcar Cabral, No 588-590, Maputo</p>
		<p class="my-1">Cell: 84 060 0103 / 84 844 4141</p>
		<p class="my-1">Email: sales@amyndm.com</p>
		<p class="my-1">Nuit: 400823766</p>
	</div>
</div>

<div id="content" class="pt-0">

	<div class="div mt-0 mb-3">
		<h5 class="text-center mt-0">Factura Proforma</h5>
	</div>
	<hr>
	<p class="my-0">Factura Nº 909990912 <span style="float: right">Data: <?= date('d-m-Y'); ?></span></p>

	<div class="div pb-1 mb-2">
		<div class="float-left" style="width: 80%">
			<p class="my-0">Ref. cliente: 0012</p>
		</div>
		<div class="float-left" style="width: 20%;">
			<p class="my-0 text-right">
				Cell: 84 060 0103
			</p>
		</div>
	</div>

	<div class="div border-top pb-0">
		<div class="float-left" style="width: 80%">
			<p class="my-0">Nome: Sr.(Att) Kec international, LDA</p>
		</div>
		<div class="float-left" style="width: 20%">
			<p class="my-0 text-right">Nuit: 128808685</p>
		</div>
	</div>
	<div class="div border-top border-bottom pb-1 mb-3">
		<div class="float-left" style="width: 40%">
			<p class="my-0">Morada: </p>
		</div>
		<div class="float-left" style="width: 40%">
			<p class="my-0">Telefone: </p>
		</div>
		<div class="float-left" style="width: 20%">
			<p class="my-0 text-right">Fax: 21 880868</p>
		</div>
	</div>


	<table class="table">
		<thead>
		<tr class="bg-light">
			<th class="border-top text-right border-left border-right" style="width: 5%">Quant</th>
			<th class="border-top border-left border-right" style="width: 55%">Descrição</th>
			<th class="border-top border-right text-right" style="width: 20%">Preço unitário</th>
			<th class="border-top border-right text-right" style="width: 20%">Total</th>
		</tr>
		</thead>
		<tbody>
		<?php $subtotal = 0;
		$counter = 0 ?>

		<?php foreach ($items as $item): ?>
			<?php $counter += 1 ?>
			<tr>
				<td class="border-bottom border-right border-left text-center"><?= $item->quantity ?></td>
				<td class="border-bottom"><?= $item->product ?></td>
				<td class="border-bottom text-right border-left border-right"><?= number_format($item->price, 2) ?></td>
				<td class="border-bottom text-right border-right"><?= number_format($item->price * $item->quantity, 2) ?></td>
			</tr>
			<?php $subtotal += $item->price * $item->quantity ?>
		<?php endforeach; ?>

		<tr class="">
			<td colspan="4" class="bg-light border">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="border-left"></td>
			<td class="text-right f-w-700" colspan="1">SUBTOTAL</td>
			<td class="text-right border"><?= number_format($subtotal, 2) ?></td>
		</tr>
		<tr>
			<td colspan="2" class="border-left"></td>
			<td class="text-right f-w-700" colspan="1">IVA 16%</td>
			<?php $tax = $subtotal * 0.16; ?>
			<td class="text-right border"><?= number_format($tax, 2) ?></td>
		</tr>
		<tr>
			<td colspan="2" class="border-left border-bottom"></td>
			<td class="text-right f-s-18 f-w-700 border-bottom" colspan="1">TOTAL</td>
			<td class="text-right f-s-18 f-w-700 bg-light border"><?= number_format($subtotal + $tax, 2) ?></td>
		</tr>
		</tbody>
	</table>
</div>

<div id="footer-column">
	<div class="div">
		<div class="float-left pr-2 f-s-10" style="width: 60%">
			<p class="f-s-10 p-2" style="text-align: justify; border: 1px dashed #dede00">
				(A Garantia não cobre calamidades naturais nem oscilação de corrente)
				Garantia do Equipamento: 12 Meses (Pelo Fabricante)
				Entrega do Equipamento: Imediato (Salvo Pré-Venda)
				A Empresa reserva se ao direito e sempre aviso de
				alteração dos preços sempre que achar necessário
			</p>

			<fieldset class="pb-0 py-0 mx-0" style="border: 1px solid #e3e6f0;">
				<legend style="top: -10px">Contas</legend>
				<table class="table table-sm my-0 py-0">
					<tr>
						<th style="width: 16%"></th>
						<th style="width: 83%"></th>
					</tr>
					<tr>
						<td class="text-right" >BCI:</td>
						<td class="pl-5">000800007212155410195</td>
					</tr>
					<tr>
						<td class="text-right">Societe Gen:</td>
						<td>001100020000015951795</td>
					</tr>
					<tr>
						<td class="text-right">ABSA:</td>
						<td class="text-left">000200383810202053317</td>
					</tr>
					<tr>
						<td class="text-right">BIM:</td>
						<td>000100000049882783657</td>
					</tr>
				</table>
			</fieldset>
		</div>
		<div class="float-left pt-4" style="width: 40%">
			<br>
			<br>
			<br>
			<p class="border-bottom text-center mb-3"></p>
			<br>
			<p class="text-center">(Departamento comercial)</p>
		</div>
	</div>
</div>

<div id="footer">
	<p class="text-center f-s-10 my-0">
		GRATOS PELA PREFERÊNCIA
	</p>
	<p class="my-0 f-s-10">Processado por computador </p>

	<p class="my-0 f-s-10">
		<span class="">Utlizador: Erika Sobrenome </span>
		<span class="float-right page">Página </span>
	</p>
</div>
</body>
</html>
