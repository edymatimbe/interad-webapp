<?php $this->load->view('layout/header') ?>

<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white py-2 rounded">
		<div class="col-6 mb-lg-0 pt-2">
			<i class="feather icon-tag text-agata border-right pr-2 mr-2"></i>
			<label class="text-capitalize" for=""><?= $this->lang->line('categories') ?></label>
		</div>
	</div>
</div>

<div class="mb-4 position-relative">
	<ul class="nav nav-pills shadow rounded" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a id="link-category-0" class="nav-link active py-3 link-category text-capitalize" data-target="0" data-toggle="pill" href="javascript:void(0)">
				<i class="feather icon-tag mr-2"></i><?=$this->lang->line('products')?>
			</a>
		</li>
		<li class="nav-item">
			<a id="link-category-1" class="nav-link py-3 link-category text-capitalize" data-target="1" data-toggle="pill" href="javascript:void(0)">
				<i class="fa fa-tools mr-2"></i><?= $this->lang->line('services') ?>
			</a>
		</li>
	</ul>
</div>

<div id="div-render"></div>


<div class="modal fade" id="modal-image-category">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body bg-light p-lg-0">
				<div class="container-fluid" style="height: 490px">
					<h6 class="text-white text-center w-100 bg-dark-transparent-5 pt-sm-2 pb-sm-2 pr-sm-2"><i
								class="fa fa-photo"></i>&nbsp;Image
						<label class="close text-danger" data-dismiss="modal">&times;</label>
					</h6>

					<div id="div-cropper-category" class="m-0"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script !src="">

	$('#menu-management').addClass('active pcoded-trigger');
	$('#menu-management .products').addClass('active');
	$('#menu-management .pcoded-submenu').css('display', 'block');

	$(document).ready(function () {
        target =localStorage.getItem('link_category');

        if(target){
            $('#link-category-'+target).trigger('click');
        }else{
            table = 1
        }
        actionClick_category(target);
    });

    $('.link-category').on('click',function () {
        target = $(this).data('target');
        actionClick_category(target)
    });

    function actionClick_category(target) {
        localStorage.setItem("link_category", target);
        $.ajax({
            type: 'POST',
            url: '<?=base_url('category/get_index')?>',
			data:{is_service:target},
            beforeSend:function(){
                show_loader()
            },
            success: function (data) {
                close_loader();
                $('#div-render').html(data);
                initDataTable('table-category')
            },
            error:function () {
                close_loader();
                show_toast_error('error')
            }
        });
    }
    $(document).on('change', '#is-sub-category', function() {
        if ($(this).prop('checked')) {
            $('#div-parent-category').removeClass('d-none').find('select').prop('required', true)
        } else {
            $('#div-parent-category').addClass('d-none').find('select').removeAttr('required', true).val('').trigger('change')
        }
    })
</script>
<?php $this->load->view('layout/footer') ?>
