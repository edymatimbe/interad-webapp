<!--<div class="" id="auth-footer">-->
<!--	<div class="col-12">-->
<!--		<p class="text-center mb-5 f-s-13">-->
<!--			Você concorda com nossa-->
<!--			<a href="#">Política de Privacidade</a>  e <a href="#">Termos e Condições</a>-->
<!--		</p>-->
<!--		<p class="text-center f-s-13">-->
<!--			Copyright © --><?//=date('Y')?><!-- Bigb Soft POS. Todos direitos reservados-->
<!--		</p>-->
<!--	</div>-->
<!--</div>-->
</div>
<input type="hidden" id="baseURL" value="<?= base_url() ?>">

<script src="<?= base_url(); ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>public/js/sb-admin-2.min.js"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="<?= base_url(); ?>public/js/jquery.slimscroll.js"></script>

<script>
    $(document).ready(function () {
        $(".preloader").fadeOut();
        close_loader();
    });

    

    function show_loader() {
        $("#loader-two").fadeIn();
        // $('#div-loader-simple').parent().removeClass('d-none').addClass('d-flex')
    }

    function close_loader() {
        $("#loader-two").fadeOut();
        // $('#div-loader-simple').parent().removeClass('d-flex').addClass('d-none')
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    function show_toast_success(msg) {
        Toast.fire({
            icon: 'success',
            title: msg
        })
    }

    function show_toast_warning(msg) {
        Toast.fire({
            icon: 'warning',
            title: msg
        })
    }

    function show_toast_error(msg) {
        Toast.fire({
            icon: 'error',
            title: msg
        })
    }
</script>
<!--local scripts-->
<?php if (isset($scripts)): ?>
	<?php foreach ($scripts as $script): ?>
		<script src="<?= base_url(); ?>public/<?= $script ?>"></script>
	<?php endforeach; ?>
<?php endif ?>

<script src="<?= base_url(); ?>public/js/app.js"></script>

<!--cdn-->
<?php if (isset($cdns_js)): ?>
	<?php foreach ($cdns_js as $cdn): ?>
		<script src="<?= $cdn ?>"></script>
	<?php endforeach; ?>
<?php endif ?>
<?php if (isset($menu_active)): ?>
	<script>
        $(document).ready(function () {
            const menu = '#<?=$menu_active?>';
            $(menu).addClass('active').find('div.collapse').addClass('show');
            $(menu).find('a.nav-link').removeClass('collapsed');
			<?php if (isset($sub_menu_active)):?>
            $(menu).find('a.<?=$sub_menu_active?>').addClass('active');
			<?php endif;?>
        })
	</script>
<?php endif ?>

</body>
</html>
