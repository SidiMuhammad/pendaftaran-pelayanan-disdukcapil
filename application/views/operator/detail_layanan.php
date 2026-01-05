<div class="app-container">
    <div class="menu-grid">
        <div class="card">
            <div class="card-header">
                <h2><?= $menu; ?></h2>
            </div>
            <div class="card-body">
                <div class="form-grid-daftar mb-2">
                    <div>
                        <label class="form-label">Data Layanan</label>
                        <table class="table-info">
                            <tbody>
                                <tr>
                                    <td>ID Layanan</td>
                                    <td class="spacer">:</td>
                                    <td><?= $layanan['id_layanan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Layanan</td>
                                    <td class="spacer">:</td>
                                    <td><?= $layanan['nama_layanan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Bagian Pelayanan</td>
                                    <td class="spacer">:</td>
                                    <td><?= $layanan['bagian_pelayanan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi Layanan</td>
                                    <td class="spacer">:</td>
                                    <td><?= $layanan['deskripsi_layanan']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <label class="form-label">Persayaratan Layanan</label>
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
                </div>
                <div class="btn-container">
                    <a class="btn btn-green" href="<?= base_url('operator/ubah_layanan/?id=' . $value['id_layanan']); ?>">UBAH LAYANAN</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
</body>

</html>