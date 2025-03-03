<div class="card-header py-0 px-0 rounded-top">
	<div class="row">
		<div class="col-4 pl-4 pt-3">
			<h6 class="pl-3">
				<i class="far fa-file-alt">&nbsp;</i> 
				<?= $this->lang->line('Invoices') ?>
			</h6>
		</div>
		<div class="col-8">
			<nav>
				<div class="nav nav-tabs bg-gray-400 pt-2 px-2 rounded-top" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-product-tab" data-toggle="tab" href="#nav-product"
					   role="tab"
					   aria-controls="nav-product" aria-selected="true"><?= $this->lang->line('Invoices') ?></a>
				</div>
			</nav>
		</div>
	</div>
</div>

<div class="card-body">
	<form>
		<div id="invoice-model" class="row ">
				<?php
					$invoice_model=get_column('setting','invoice_model',['company_id'=>$this->session->userdata('company_id')])[0]->invoice_model
				?>
				<input type="hidden" name="invoice_model" value="<?=$invoice_model?>">
				<div class="box-fatura" data-invoice_model="modelo1"  >
					<img  onload="addEnventClick()" class="img-fatura" src="<?=base_url('public/img/faturas/modelo1.png')?>" alt="Modelo 1 da factura">
				</div>
				<div class="box-fatura" data-invoice_model="modelo2" >
					<img  class="img-fatura" src="<?=base_url('public/img/faturas/modelo2.png')?>" alt="Modelo 2 da factura">
				</div>
				<div class="box-fatura" data-invoice_model="modelo3" >
					<img  class="img-fatura" src="<?=base_url('public/img/faturas/modelo3.png')?>" alt="Modelo 3 da factura">
				</div>
		</div>
		
	</form>
</div>

