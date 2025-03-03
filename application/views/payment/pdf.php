<!DOCTYPE html>
<html>

<head>
    <title>Relatório</title>
    <link href="<?= base_url(); ?>public/css/pdf.css" rel="stylesheet">
    <style>
        @page {
            margin: 250px 40px 40px 40px;
        }

        header {
            position: fixed;
            top: -220px;
            left: 0;
            right: 0;
            height: 140px;
        }

        footer {
            position: fixed;
            bottom: -120px;
            left: 0;
            right: 0;
            height: 120px;
        }
    </style>
</head>

<body>
<?php $company = get_setting() ?>
<header>
    <div id="header" style="width: 100%;">
        <div class="float-left" style="width: 30%; position: relative">
            <p style="position: absolute; top: 0; left: -15px">
                <img width="165" src="<?= base_url('public/img/logo/logo.png') ?>" alt="image">
            </p>
        </div>
        <div class="float-left pt-5" style="width: 55%;">
            <?php if ($company->nuit) : ?>
                <p class="my-1">Nuit: <?= $company->nuit ?></p>
            <?php endif; ?>
            <p class="my-1"><?= $company->address . ', ' . $company->city ?></p>
            <p class="my-1">Cell: <?= $company->phone ?> <?= ($company->phone2) ? ' / ' . $company->phone2 : '' ?> </p>
            <?php if ($company->email) : ?>
                <p class="my-1">Email: <?= $company->email ?></p>
            <?php endif; ?>
        </div>

        <div class="float-right position-relative" style="width: 32%;height: 110px;">
            <div class="position-absolute border-dashed-all" style="width: 100%; height: 90px; right: 0; top: 50px">
                <p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280">
                    Pagamentos
                </p>
                <div class="my-0 text-right px-2">
                    <p>
                        Período:
                        <?php
                        if ($init_date === $final_date) :
                           echo simple_date($init_date,'d-m-Y');
                        else :
                           echo simple_date($init_date,'d-m-Y'). ' à ' . simple_date($final_date,'d-m-Y');
                        endif;
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
<footer>
    <p class="my-0 f-s-9">
        <span class="text-muted">Documento processado por computador / © <strong><?= get_setting()->name ?></span>
    </p>
</footer>

<main>
    <table class="table f-s-10 table-bordered">
        <thead>
        <tr class="bg-light">
            <th style="width: 5%" class="text-left">#</th>
            <th style="width: 10%" class="text-left">Recibo</th>
            <th style="width: 25%" class="text-left">Cliente</th>
            <th style="width: 20%" class="text-left">Forma de pagamento</th>
            <th style="width: 20%" class="text-center">Data</th>
            <th style="width: 20%" class="text-right">Valor pago</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0;?>
        <?php foreach ($payments as $key => $payment): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $payment->receipt ?></td>
                <td><?= $payment->customer ?></td>
                <td><?= $payment->pay_method_name ?></td>
                <td class="text-center"><?= simple_date($payment->created_at, 'd-m-Y H:i') ?></td>
                <td class="text-right"><?= number_format($payment->amount, 2) ?></td>
                <?php $total += $payment->amount?>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5"><strong>TOTAL</strong></td>
            <td class="text-right"><strong><?=number_format($total,2)?></strong></td>
        </tr>
        </tfoot>
    </table>
</main>
</body>

</html>
