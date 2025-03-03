<!DOCTYPE html>
<html>
<head>
	<title>Receipt 0001</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
	<style>
		#frame{
			font-family: 'Rubik', sans-serif;
			font-size: 22px;
		}
		#title{
			text-align: center;
			/*margin-bottom: 6rem;*/
			font-size: 32px;
		}
		#table {
			width: 100%;
			margin-bottom: 1rem;
			/*color: #3c3f41;*/
			border-bottom: 1px solid #e3e6f0;
		}

		#table th, #table td {
			padding: 0.4rem;
			vertical-align: center;
			margin: 0;
		}
		#table th:nth-child(1){
			text-align: left;
		}
		#table th:nth-child(2){
			text-align: left;
		}
		#table th:nth-child(3){
			text-align: left;
		}
		#table th:nth-child(4){
			text-align: right;
		}

		#table td {
			text-align: left;
			border-top: 1px solid #e3e6f0;
		}
		#table td:nth-child(4) {
			text-align: right;
			/*border-top: 1px solid #e3e6f0;*/
		}

		/*	table summary*/
		#table-summary{
			width: 100%;
		}
		#table-summary td{
			padding: 0.4rem;
			vertical-align: center;
			text-align: right;
		}
		#footer{
			text-align: center;
			/*margin-top: 4rem;*/
		}
		#moeda{
			text-align: right;
		}
	</style>
</head>
<body>

<div id="frame">
	<h1 id="title">GREEN REVOLUTION</h1>
	<p>Av. Amilcar Cabral, No 588-590, Maputo</p>
	<p>NUIT:### ### ### Cel:+258 86 303 3333</p>
	<p style="text-align: center">Data: <?= date('d-m-Y'); ?></p>
	<p>Cliente: client_name</p>
	<p id="moeda">Moeda: Metical</p>
	<table id="table">
		<thead>
		<tr>
			<th style="width: 50%">Item</th>
			<th style="width: 20%">P. unitário</th>
			<th style="width: 10%">Qtd</th>
			<th style="width: 20%">Subtotal</th>
		</tr>
		</thead>
		<tbody>
		<?php $subtotal = 0 ?>

		<?php foreach ($items as $item): ?>
			<tr>
				<td><?= $item->product ?></td>
				<td><?= $item->price ?></td>
				<td><?= $item->quantity ?></td>
				<td class="rr"><?= number_format($item->price * $item->quantity, 2) ?></td>
			</tr>
			<?php $subtotal += $item->price * $item->quantity ?>
		<?php endforeach; ?>
		</tbody>
	</table>

	<table id="table-summary">
		<thead>
		<tr>
			<th style="width: 80%"></th>
			<th style="width: 20%"></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Sub-total:</td>
			<td><?=$subtotal?></td>
		</tr>
		<tr>
			<td>Disconto:</td>
			<td>0,00</td>
		</tr>
		<tr>
			<td>Total:</td>
			<td><?= number_format($subtotal, 2) ?></td>
		</tr>
		<tr>
			<td>Valor pago:</td>
			<td>2000,00</td>
		</tr>
		<tr>
			<td>Troco:</td>
			<td>500,00</td>
		</tr>
		</tbody>
	</table>
	<h5 id="footer">Muito obrigado e ate breve</h5>
</div>

<script>
	// alert()
	// window.print()
	printJS({
		printable: 'dialog',
		type: 'html',
	})
</script>
</body>
</html>
