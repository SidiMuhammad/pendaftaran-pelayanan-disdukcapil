<!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/all.min.css'); ?>">
<title><?= $title; ?></title>
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