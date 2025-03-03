<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= (isset($title) ? '41 BUSNESS CENTER | ' . $title : '41 BUSNESS CENTER') ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.8, shrink-to-fit=no">
    <meta name="description" content="plataforma de publicidade">
    <meta name="author" content="Edy Matimbe, Florencio Cau">
    <link rel="icon" href="<?= base_url(); ?>public\41\src.png">
    <link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>public/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/v4-shims.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/vendor/feather-icon/feather.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/vendor/bootstrap4-toggle/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>public/vendor/select2/select2.min.css" rel="stylesheet" type="text/css">
    <script src="<?= base_url(); ?>public/js/vendor-all.min.js"></script>
    <script src="<?= base_url(); ?>public/vendor/sweetalert2/sweetalert2.all.min.js"></script>

    <link href="<?php echo base_url(); ?>public/css/custom.css" rel="stylesheet">
    <script src="<?= base_url(); ?>public/js/custom.js"></script>



    <?php if (isset($styles)) : ?>
        <?php foreach ($styles as $style) : ?>
            <link href="<?= base_url() ?>public/<?= $style ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif ?>


    <?php if (isset($cdns_css)) : ?>
        <?php foreach ($cdns_css as $cdn) : ?>
            <link href="<?= $cdn ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif ?>

    <style>
        body {
            zoom: 0.8 !important;
        }

        .pcoded-navbar.menupos-fixed,
        .pcoded-main-container {
            min-height: 125vh !important;
        }

        /*90*/
        /*body{*/
        /*	zoom: 0.9 !important;*/
        /*}*/
        /*.pcoded-navbar.menupos-fixed, .pcoded-main-container{*/
        /*	min-height: 111vh !important;*/
        /*}*/
    </style>
</head>

<body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="preloader" id="loader-one">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
    <div class="preloader-2" id="loader-two">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
    <div id="wrapper">

        <nav class="pcoded-navbar menu-light menupos-fixed bg-light shadow-lg">
            <div class="navbar-wrapper">
                <div class="navbar-content scroll-div ps ps--active-y">
                    <div class="">
                        <div class="main-menu-header">
                            <img class="img-radius" src="<?= base_url(); ?>public/img/avatar/avatar.svg" alt="User-Profile-Image">
                            <div class="user-details">
                                <?php $user = $this->core_model->get_by_id('users', array('id' => $this->ion_auth->get_user_id())) ?>
                                <div id="more-details"><?= $user->first_name ?> <i class="fa fa-caret-down"></i></div>
                            </div>
                        </div>
                        <div class="collapse" id="nav-user-link">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="<?= base_url('profile') ?>" data-toggle="tooltip" title="" data-original-title="View Profile"><i class="feather icon-user"></i></a></li>
                                <li class="list-inline-item"><a href="#" onclick="logOut()" data-toggle="tooltip" title="" class="text-danger" data-original-title="Logout"><i class="feather icon-power"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <ul class="nav pcoded-inner-navbar pt-2">
                        <li class="nav-item " id="menu-dashboard">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link has-ripple">
                                <span class="pcoded-micon">
                                    <i class="feather icon-home"></i>
                                </span>
                                <span class="pcoded-mtext"><?= $this->lang->line('dashboard') ?></span>
                            </a>
                        </li>
                        <li class="nav-item " id="menu-dashboard">
                            <a href="<?= base_url('advertiser') ?>" class="nav-link has-ripple">
                                <span class="pcoded-micon">
                                    <i class="feather icon-home"></i>
                                </span>
                                <span class="pcoded-mtext">Advertiser</span>
                            </a>
                        </li>
                        <li class="nav-item " id="menu-tax">
                            <a href="<?= base_url('tax') ?>" class="nav-link has-ripple">
                                <span class="pcoded-micon">
                                    <i class="feather icon-shopping-cart"></i>
                                </span>
                                <span class="pcoded-mtext">Tax</span>
                            </a>
                        </li>
                        <li class="nav-item " id="menu-newspaper">
                            <a href="<?= base_url('newspapers') ?>" class="nav-link has-ripple">
                                <span class="pcoded-micon">
                                    <i class="feather icon-shopping-cart"></i>
                                </span>
                                <span class="pcoded-mtext">Jornal</span>
                            </a>
                        </li>
                        <li class="nav-item" id="menu-banners">
                            <a href="<?= base_url('banner') ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-image"></i></span><span class="pcoded-mtext ">Publicidade</span></a>
                        </li>
                        <li class="nav-item" id="menu-invoices">
                            <a href="<?= base_url('invoice') ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext ">Facturas</span></a>
                        </li>

                        <li class="nav-item pcoded-hasmenu" id="menu-payment">
                            <a href="javascript:void(0)" class="nav-link has-ripple">
                                <span class="pcoded-micon"><i class="fa fa-money-check"></i></span>
                                <span class="pcoded-mtext"><?= 'Pagamentos'?></span>
                                <span class="ripple ripple-animate load-ripple"></span>
                            </a>
                            <ul class="pcoded-submenu" style="display: none;">
                                <li class="create">
                                    <a href="<?= base_url('add-payment') ?>"><?= 'Novo' ?></a>
                                </li>
                                <li class="index"><a href="<?= base_url('payments') ?>"><?='Recibos' ?></a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item d-none" id="menu-company">
                            <a href="<?= base_url('company') ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-image"></i></span><span class="pcoded-mtext ">Company</span></a>
                        </li>
                        <li class="nav-item " id="menu-users">
                            <a href="<?= base_url('users') ?>" class="nav-link has-ripple">
                                <span class="pcoded-micon">
                                    <i class="feather icon-users"></i>
                                </span>
                                <span class="pcoded-mtext">Utilizadores</span>
                            </a>
                        </li>
                        <?php if ($this->ion_auth->in_group(array('admin', 'super admin'))) : ?>
                            <li class="nav-item pcoded-hasmenu " id="menu-system ">
                                <a href="javascript:void(0)" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                                    <span class="pcoded-mtext">Definições</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="<?= base_url('settings') ?>"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext ">Geral</span></a>
                                    </li>

                                    <li class="d-none"><a href="<?= base_url('banks') ?>"><span class="pcoded-micon"><i class="fal fa-university"></i></span></a></li>
                                    <li class="d-none"><a href="<?= base_url('account_bank') ?>"><span class="pcoded-micon"><i class="feather icon-server"></i></span>Contas
                                            bancarias</a></li>

                                    <li class="d-none"><a href="<?= base_url('banks-and-services') ?>"><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>Bancos e
                                            Serviços</a></li>
                                    <li class="d-none"><a href="<?= base_url('document-types') ?>"><span class="pcoded-micon"><i class="feather icon-file-minus"></i></span>Tipos de
                                            documentos</a></li>
                                    <li><a href="<?= base_url('local') ?>"><span class="pcoded-micon"><i class="feather icon-map-pin"></i></span>Divisão admninistrativa</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                    </ul>

                    <div class="ps__rail-x" style="left: 0px; bottom: -150px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 150px; height: 536px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 93px; height: 1207px;"></div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="navbar pcoded-header navbar-expand-lg shadow-lg bg-light headerpos-fixed p-1">
            <div class="m-header">
                <a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)"><span></span></a>

                <a href="" class="b-brand">
                    <img src="<?= base_url(); ?>public\41\logo-sm.png" width="155px" alt="Logo" class="logo">
                </a>
                <a href="javascript:void(0)" class="mob-toggler">
                    <i class="feather icon-more-vertical"></i>
                </a>

            </div>
            <div class="collapse navbar-collapse pl-4">
                <div class="col-md-2 mb-2 mb-lg-0 position-relative">
                    <div class="btn-group ml-n3">

                    </div>
                </div>
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle mr-3" data-toggle="dropdown">
                                <?php if ($this->session->userdata('site_lang') == 'english') : ?>
                                    <img src="<?= base_url(); ?>public/img/flag-gb.png" alt="">
                                <?php else : ?>
                                    <img src="<?= base_url(); ?>public/img/flag-mz.png" alt="">
                                <?php endif; ?>
                                <span class="text-dark small pl-1">
                                    <?= ($this->session->userdata('site_lang') == 'english') ? 'EN' : 'PT' ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <ul class="pro-body">
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="window.location.href='<?php echo base_url(); ?>LanguageSwitcher/index/portuguese';">
                                            <img src="<?= base_url(); ?>public/img/flag-mz.png" alt="">
                                            <span class="pl-2">PT</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="window.location.href='<?php echo base_url(); ?>LanguageSwitcher/index/english';">
                                            <img src="<?= base_url(); ?>public/img/flag-gb.png" alt="">
                                            <span class="pl-2">EN</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="feather icon-user text-primary border-left pl-3"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img src="<?= base_url(); ?>public/img/avatar/avatar.svg" class="img-radius" alt="User-Profile-Image">
                                    <span><?= $user->first_name . ' ' . $user->last_name ?></span>
                                    <a href="#" onclick="logOut()" class="dud-logout" title="Logout">
                                        <i class="feather icon-log-out"></i>
                                    </a>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="<?= base_url('profile') ?>" class="dropdown-item"><i class="feather icon-user"></i>
                                            <?= $this->lang->line('dd_profile') ?></a>
                                    </li>
                                    <li><a href="#" onclick="logOut()" class="dropdown-item"><i class="feather icon-lock"></i><?= $this->lang->line('dd_logout') ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <div class="pcoded-main-container">
            <div class="pcoded-content" id="wrapper">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">

                </div>