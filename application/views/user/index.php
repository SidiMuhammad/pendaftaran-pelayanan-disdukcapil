<div class="app-container">
    <div class="menu-grid">
        <?php foreach ($layanan as $key => $value) : ?>
            <div class="card card-item">
                <div class="card-image">
                    <img src="<?= base_url('assets/img/kk.jpg'); ?>" alt="">
                </div>
                <div class="card-header">
                    <h3><?= $value['nama_layanan']; ?></h3>
                </div>
                <div class="card-description">
                    <p><?= $value['deskripsi_layanan']; ?></p>
                </div>
                <div class="card-option">
                    <a class="btn btn-gray" href="<?= base_url('persyaratan/?layanan=' . $value['id_layanan']); ?>">PERSYARATAN</a>
                    <a class="btn btn-green" href="<?= base_url('pendaftaran/?layanan=' . $value['id_layanan']); ?>">DAFTAR</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
</body>