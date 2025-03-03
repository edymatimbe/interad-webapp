<?php $this->load->view('layout/header') ?>


<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white py-2 rounded">
		<div class="col-6 mb-lg-0 pt-2">
			<i class="feather icon-shopping-cart text-agata border-right pr-2"></i>
			<label for="" class="text-capitalize"><?= $title ?></label>
		</div>
		<div class="col-6">
			<a id="btn-new-sale" class="btn btn-dark float-right text-nowrap" href="<?=base_url('new-invoice-service')?>">
				<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('new2')?>
				<span id="btn-new-sale-span" class="text-lowercase"><?=$this->lang->line('invoice')?></span>
			</a>
		</div>
	</div>
</div>

<div class="mb-4 position-relative">
	<ul class="nav nav-pills shadow rounded" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a id="link-history-invoice" class="nav-link active py-3 link-history" data-target="invoice" data-toggle="pill" href="javascript:void(0)">
				<i class="feather icon-file mr-2"></i><?= $this->lang->line('Invoices') ?>
			</a>
		</li>
		<li class="nav-item">
			<a id="link-history-note" class="nav-link py-3 link-history" data-target="note"  data-toggle="pill" href="javascript:void(0)" role="tab">
				<i class="feather icon-file-text mr-2"></i><?='Notas de crédito e débito'?>
			</a>
		</li>
		<li class="nav-item">
			<a id="link-history-quotation" class="nav-link py-3 link-history" data-target="quotation"  data-toggle="pill" href="javascript:void(0)" role="tab">
				<i class="feather icon-file-text mr-2"></i><?=$this->lang->line('quotations')?>
			</a>
		</li>
	</ul>
</div>
<input type="hidden" id="target"/>
<div id="div-render-table"></div>

<div id="modal-sale" class="modal fixed-left fade" tabindex="-1" role="dialog" data-backdrop="static">
	<button id="btn-close-modal-sale" class="btn bg-white position-absolute" data-dismiss="modal">
		<i class="fa fa-close"></i>
	</button>
	<div class="modal-dialog modal-dialog-aside" role="document">
		<div class="modal-content" id="modal-sale-content">
		</div> 
	</div>
</div>
<script src="<?=base_url('public/vendor/moment/moment.js')?>"></script>
<script src="<?=base_url('public/assets/sale/index.js')?>"></script>
<script>

    $(document).ready(function () {
		
        if(target == 'sale' || !target){
            $('#link-history-invoice').trigger('click')
        }

        if(localStorage.getItem('note_saved')){
            $('#link-history-note').trigger('click');
			localStorage.removeItem('note_saved')
        }

    })

</script>

<?php $this->load->view('layout/footer') ?>
