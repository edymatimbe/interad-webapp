<?php $this->load->view('layout/header') ?>


<style>
	.select2-container--default .select2-selection--single {
		border: 1px solid #d1d3e2;
		border-radius:  3px;
		outline: none;
		height: 38px;
		padding-top: 5px;
		padding-left: 30px;
	}
	.select2-container--default .select2-search--dropdown .select2-search__field{
		outline: none;
	}
</style>

<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white py-2 rounded">
		<div class="col-md-3 mb-2 mb-lg-0 position-relative">
			<select id="select-sale-type-report" class="select2-no-search pl-5 w-100">
				<option value="sale"> <?=$this->lang->line('vds')?></option>
				<option value="invoice"> <?=$this->lang->line('vcs')?></option>
			</select>
			<i class="feather icon-bar-chart-2 text-agata position-absolute border-right pr-2" style="left: 27px; top: 13px"></i>
		</div>
	</div>
</div>

<script !src="">
    $(document).ready(function () {
        $('#menu-dashboard').addClass('active pcoded-trigger');
        $('#menu-dashboard .sale').addClass('active');
        $('#menu-dashboard .pcoded-submenu').css('display', 'block')
    })
</script>
<?php $this->load->view('layout/footer') ?>
