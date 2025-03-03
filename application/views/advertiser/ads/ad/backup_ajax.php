<script>
    $(document).ready(function() {
        var bar = $('.bar');
        var percent = $('.percent');
        var progress = $('#progress');
        var submit = $('#submit');
        progress.removeClass('d-none');


        $('form').ajaxForm({
            progress.removeClass('d-none');
            beforeSend: function() {
                var percentage = '0%';
                bar.width(percentage);
                percent.html(percentage)
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentage = percentComplete + '%';
                bar.width(percentage);
                percent.html(percentage)
            },
            complete: function() {
                alert('SUccessfully')
            }
        });





    })
</script>
<script>
    $(document).on('submit', '#form-ads', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Salvar a factura?",
            text: "Após apresentar o recibo da factura a sua campanha será publicada ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#6fc242",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, salvar a factura!"
        }).then((result) => {
            $.ajax({
                url: "<?= base_url('public/advertiser/save') ?>",
                type: 'POST',
                dataType: "JSON",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    if (data.status.toString() === 'success') {

                        Swal.fire({
                            title: "sucesso",
                            text: "Factua salva com sucesso, efectue o pagamento para activar a campanha.",
                            icon: "success"
                        }).then((result) => {
                            window.location = '<?= base_url('profile-billing') ?>'
                        });
                    }
                    if (data.status.toString() === 'error') {
                        Swal.fire({
                            title: "Error, ao salvar a factura",
                            text: "Por favor verfique se os campos estão bem preechidos",
                            icon: "error"
                        });
                    }

                    if (data.status.toString() === 'error_validation') {
                        setErrorValidation(data)
                    }
                },
                error: function(xhr, status, error) {
                    console.log(JSON.stringify(error))
                }
            })
        });


    });
</script>