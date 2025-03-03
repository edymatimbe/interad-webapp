<?php $this->load->view('layout/header') ?>

<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2 mt-1">
            <i class="feather icon-image text-micro border-right pr-2"></i>
            <label for=""><?= 'Configuração de baners' ?></label>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5><strong> Formulario de banner </strong></h5>
            </div>
            <div class="card-body">
                <div id="container">
                    <h1>CodeIgniter Video Upload</h1>

                    <div id="body">
                        <p>Select a video file to upload</p>
                        <?php
                        if (isset($success) && strlen($success)) {
                            echo '<div class="success">';
                            echo '<p>' . $success . '</p>';
                            echo '</div>';

                            //traditional video play - less than HTML5
                            echo '<object width="338" height="300">
						  <param name="src" value="' . $video_path . '/' . $video_name . '">
						  <param name="autoplay" value="false">
						  <param name="controller" value="true">
						  <param name="bgcolor" value="#333333">
						  <embed type="' . $video_type . '" src="' . $video_path . '/' . $video_name . '" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed>
						  </object>';

                            //HTML5 video play
                            /*echo '<video width="320" height="240" controls>
						  <source src="' . $video_path . '/' . $video_name . '" type="' . $video_type . '">
						  Your browser does not support the video tag.
						  </video>';*/
                        }
                        if (isset($errors) && strlen($errors)) {
                            echo '<div class="error">';
                            echo '<p>' . $errors . '</p>';
                            echo '</div>';
                        }
                        if (validation_errors()) {
                            echo validation_errors('<div class="error">', '</div>');
                        }
                        ?>
                        <?php
                        $attributes = array('name' => 'video_upload', 'id' => 'video_upload');
                        echo form_open_multipart($this->uri->uri_string(), $attributes);
                        ?>
                        <p><input name="video_name" id="video_name" readonly="readonly" type="file" /></p>
                        <p><input name="video_upload" value="Upload Video" type="submit" /></p>
                        <?php
                        echo form_close();
                        ?>
                    </div>

                </div>


            </div>

        </div>
    </div>
</div>



<?php $this->load->view('layout/footer') ?>
<script type="text/javascript">
    $(document).ready(function() {
        var contest_id = $('#contest').val();
        initDataTable('table-banner');
        getAllData()
        get_form(null, contest_id)
    });

    cropImage(
        'image_banner',
        'file_image_banner',
        'image_data_banner',
        'modal-image',
        'div-cropper', 100, 400
    );

    $(document).on('submit', '#form-banner', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?= base_url('banner/save') ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function() {
                show_loader()
            },
            success: function(data) {
                close_loader();
                console.log(data)


                // if (data.status.toString() === 'success') {
                //     show_message(data.message, data.status);
                //     getAllData()
                //     get_form()
                //     setTimeout(function() {
                //         window.location = '<?= base_url('banner') ?>'
                //     }, 2000)
                // }

                // if (data.status.toString() === 'error') {
                //     show_message(data.message, data.status);
                // }

                // if (data.status.toString() === 'error_validation') {
                //     setErrorValidation(data)
                // }
            },
            error: function() {
                close_loader();
                show_message('Error ao salvar banner', 'error')
                // console.log(data)
            }
        })

    });

    function getAllData() {
        $.ajax({
            url: "<?= base_url('banner/getAll') ?>",
            type: 'GET',
            success: function(data) {
                reDrawTable(data)
            },
        });
    }

    // $(document).ready(function() {
    //     $( "#foo" ).trigger( "click" );

    //     $("button").click(function() {
    //         $("input").trigger("select");
    //     });
    // });

    function get_form(id = null, contest_id = null) {
        // alert(contest_id)
        $.ajax({
            url: "<?= base_url('banner/form') ?>",
            type: 'POST',
            dataType: "JSON",
            data: {
                id,
                contest_id
            },
            success: function(data) {
                $('#form').html(data);
            },
        });
    }
</script>