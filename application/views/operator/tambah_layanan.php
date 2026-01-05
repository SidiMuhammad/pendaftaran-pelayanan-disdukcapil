<div class="app-container">
    <div class="card">
        <div class="card-header">
            <h2><?= $menu; ?></h2>
        </div>
        <div class="card-body">
            <form id="form_tambah_layanan" method="POST" action="<?= base_url('operator/tambah_layanan/validation'); ?>">
                <div class="form-grid-daftar">
                    <div>
                        <div class="mb-1">
                            <label class="form-label" for="jenis">Nama Layanan</label>
                            <div class="input-group">
                                <input id="jenis" name="jenis" type="text" class="form-input" placeholder="Nama Layanan">
                            </div>
                            <div id="jenis_error" class="form-warning"></div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Bagian Pelayanan</label>
                            <div class="radio-input-container">
                                <input id="pelayanan_depan" name="bagian" type="radio" value="Depan" checked>
                                <label class="label-radio" for="pelayanan_depan">
                                    <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Depan
                                </label>
                                <input id="pelayanan_belakang" name="bagian" type="radio" value="Belakang">
                                <label class="label-radio" for="pelayanan_belakang">
                                    <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Belakang
                                </label>
                            </div>
                            <div id="bagian_error" class="form-warning"></div>
                        </div>
                        <div>
                            <label class="form-label" for="deskripsi">Deskripsi Layanan</label>
                            <div class="input-group">
                                <textarea id="deskripsi" name="deskripsi" cols="1" rows="5" class="form-input" placeholder="Deskripsi Layanan"></textarea>
                            </div>
                            <div id="deskripsi_error" class="form-warning"></div>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Persyaratan Layanan</label>
                        <div class="input-group">
                            <ul class="input-list">
                                <li>
                                    <span>1</span>
                                    <textarea id="syarat" name="syarat[]" cols="1" rows="1" class="form-input" placeholder="Syarat Layanan"></textarea>
                                </li>
                                <li>
                                    <span>2</span>
                                    <textarea id="syarat" name="syarat[]" cols="1" rows="1" class="form-input" placeholder="Syarat Layanan"></textarea>
                                </li>
                            </ul>
                            <a class="btn btn-green tambah-syarat">Tambah Syarat</a>
                        </div>
                        <div id="syarat_error" class="form-warning"></div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-green">TAMBAH LAYANAN</button>
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