<div class="app-container">
    <div class="card">
        <div class="card-header">
            <h2><?= $menu; ?></h2>
        </div>
        <div class="card-body">
            <form id="form_tambah_layanan" method="POST" action="<?= base_url('operator/ubah_layanan/validation'); ?>">
                <input type="hidden" name="id_layanan" value="<?= $layanan['id_layanan']; ?>">
                <div class="form-grid-daftar">
                    <div>
                        <div class="mb-1">
                            <label class="form-label" for="jenis">Nama Layanan</label>
                            <div class="input-group">
                                <input id="jenis" name="jenis" type="text" class="form-input" placeholder="Nama Layanan" value="<?= $layanan['nama_layanan']; ?>">
                            </div>
                            <div id="jenis_error" class="form-warning"></div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Bagian Pelayanan</label>
                            <div class="radio-input-container">
                                <input id="pelayanan_depan" name="bagian" type="radio" value="Depan" <?php if ($layanan['bagian_pelayanan'] == 'Depan') echo 'checked'; ?>>
                                <label class="label-radio" for="pelayanan_depan">
                                    <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Depan
                                </label>
                                <input id="pelayanan_belakang" name="bagian" type="radio" value="Belakang" <?php if ($layanan['bagian_pelayanan'] == 'Belakang') echo 'checked'; ?>>
                                <label class="label-radio" for="pelayanan_belakang">
                                    <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Belakang
                                </label>
                            </div>
                            <div id="bagian_error" class="form-warning"></div>
                        </div>
                        <div>
                            <label class="form-label" for="deskripsi">Deskripsi Layanan</label>
                            <div class="input-group">
                                <textarea id="deskripsi" name="deskripsi" cols="1" rows="5" class="form-input" placeholder="Deskripsi Layanan"><?= $layanan['deskripsi_layanan']; ?></textarea>
                            </div>
                            <div id="deskripsi_error" class="form-warning"></div>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Persyaratan Layanan</label>
                        <div class="input-group">
                            <ul class="input-list">
                                <?php foreach ($syarat as $key => $value) : ?>
                                    <li>
                                        <span><?= $key + 1; ?></span>
                                        <textarea id="syarat" name="syarat[<?= $value['id_syarat']; ?>]" cols="1" rows="1" class="form-input" placeholder="Syarat Layanan"><?= $value['nama_syarat']; ?></textarea>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div id="syarat_error" class="form-warning"></div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-green">UBAH LAYANAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/form-tambah-layanan.js'); ?>"></script>
</body>

</html>