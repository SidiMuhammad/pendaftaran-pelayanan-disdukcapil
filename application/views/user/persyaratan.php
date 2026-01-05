<div class="app-container">
    <div class="menu-grid">
        <div class="card">
            <div class="card-header">
                <h2><?= $menu; ?></h2>
            </div>
            <div class="card-body">
                <div class="persyaratan-container mb-2">
                    <table class="table-info">
                        <tbody>
                            <?php foreach ($syarat as $key => $value) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td class="spacer"></td>
                                    <td><?= $value['nama_syarat']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="btn-container">
                    <a class="btn btn-green" href="<?= base_url('pendaftaran/?layanan=' . $layanan['id_layanan']); ?>">DAFTAR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
</body>

</html>