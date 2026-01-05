<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/all.min.css'); ?>">
<title><?= $menu; ?></title>
</head>

<body>
    <div class="message-wrapper">
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="card message <?= $this->session->flashdata('message_type'); ?>">
                <?php if ($this->session->flashdata('message_type') == 'error') : ?>
                    <i class="fa-solid fa-circle-exclamation error"></i>
                <?php elseif ($this->session->flashdata('message_type') == 'warning') : ?>
                    <i class="fa-solid fa-circle-exclamation warning"></i>
                <?php elseif ($this->session->flashdata('message_type') == 'success') : ?>
                    <i class="fa-solid fa-circle-check success"></i>
                <?php endif ?>
                <p><?= $this->session->flashdata('message'); ?></p>
                <div class="btn-close"><i class="fa-solid fa-xmark"></i></div>
            </div>
        <?php endif ?>
    </div>
    <div class="navbar-shadow"></div>
    <div class="navbar-container">
        <div class="navbar">
            <div class="navbar-left">
                <i class="fa-solid fa-bars"></i>
                <a class="logo-container" href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/img/kebumen_logo.png'); ?>" alt="logo_kebumen">
                    <div>
                        <span>SISTEM PENDAFTARAN ONLINE<br>PELAYANAN DISDUKCAPIL KEBUMEN</span>
                    </div>
                </a>
            </div>
            <div class="user-container">
                <a class="user-dropdown">
                    <div class="user-status">
                        <h4><?= $name; ?></h4>
                        <span><?= $role; ?></span>
                    </div>
                    <div class="avatar">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                </a>
                <div class="card dropdown-menu user">
                    <ul>
                        <li>
                            <a href="<?= base_url('operator/logout'); ?>">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-container">
        <div class="card sidebar">
            <ul>
                <li class="list-level-1">
                    <a>
                        <i class="fa-solid fa-chart-line menu-icon"></i>
                        <h3>Statistik</h3>
                    </a>
                </li>
                <li class="list-level-1">
                    <a>
                        <i class="fa-solid fa-list-ol menu-icon"></i>
                        <h3 class="flex-grow-1">Antrian</h3>
                        <i class="fa-solid fa-angle-down menu-arrow"></i>
                    </a>
                    <ul>
                        <li class="list-level-2">
                            <a <?php if ($menu == "Antrian Pelayanan") echo 'class="menu-active"'; ?> href="<?= base_url('operator/antrian_layan'); ?>">
                                <i class="fa-solid fa-circle"></i>
                                <h3>Antrian Pelayanan</h3>
                            </a>
                        </li>
                        <li class="list-level-2">
                            <a <?php if ($menu == "Riwayat Antrian") echo 'class="menu-active"'; ?> href="<?= base_url('operator/riwayat_antrian'); ?>">
                                <i class="fa-solid fa-circle"></i>
                                <h3>Riwayat Antrian</h3>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>