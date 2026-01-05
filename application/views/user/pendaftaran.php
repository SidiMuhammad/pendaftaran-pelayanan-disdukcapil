<div class="app-container">
    <div class="card">
        <div class="card-header">
            <h2><?= $menu; ?></h2>
        </div>
        <div class="card-body">
            <form id="form_daftar" method="POST" action="<?= base_url('pendaftaran/validation'); ?>">
                <div class="form-grid-daftar">
                    <div>
                        <div class="mb-2">
                            <label class="form-label">Pilih Jenis Layanan</label>
                            <div class="checkbox-input-container-jenis">
                                <?php foreach ($layanan as $key => $value) : ?>
                                    <div class="checkbox-button">
                                        <input id="jenis_<?= $value['id_layanan']; ?>" name="jenis[]" type="checkbox" value="<?= $value['id_layanan']; ?>" <?php if ($selected == $value['id_layanan']) echo 'checked'; ?>>
                                        <label class="label-checkbox-jenis" for="jenis_<?= $value['id_layanan']; ?>">
                                            <i class="fas fa-square"></i><i class="fa-solid fa-square-check"></i><?= $value['nama_layanan']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div id="jenis_error" class="form-warning"></div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Pilih Tanggal Pelayanan</label>
                            <div class="calendar-input-container">
                                <input id="date_daftar" type="date" name="date">
                                <div class="calendar-header">
                                    <div class="calendar-arrow prev">
                                        <i class="fa-solid fa-angle-left menu-arrow"></i>
                                    </div>
                                    <label class="calendar-month-year"></label>
                                    <div class="calendar-arrow next">
                                        <i class="fa-solid fa-angle-right menu-arrow"></i>
                                    </div>
                                </div>
                                <div class="calendar">
                                    <div class="days-name">
                                        <div>Min</div>
                                        <div>Sen</div>
                                        <div>Sel</div>
                                        <div>Rab</div>
                                        <div>Kam</div>
                                        <div>Jum</div>
                                        <div>Sab</div>
                                    </div>
                                    <div class="days-number">
                                    </div>
                                </div>
                            </div>
                            <div id="date_error" class="form-warning"></div>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Periksa Kelengkapan Dokumen Persayaratan</label>
                        <div class="mb-2">
                            <div class="checkbox-input-container-syarat">
                                <?php foreach ($layanan as $key => $value) : ?>
                                    <div class="list-container-syarat" data-jenis="<?= $value['id_layanan']; ?>">
                                        <label><?= $value['nama_layanan']; ?></label>
                                        <ul>
                                            <?php foreach ($syarat[$key] as $key2 => $value2) : ?>
                                                <li>
                                                    <input id="syarat_<?= $value2['id_syarat']; ?>" name="syarat[<?= $value['id_layanan']; ?>][]" type="checkbox" value="<?= $value2['id_syarat']; ?>">
                                                    <label class="label-checkbox-syarat" for="syarat_<?= $value2['id_syarat']; ?>">
                                                        <i class="fa-regular fa-square"></i><i class="fa-solid fa-square-check"></i><?= $value2['nama_syarat']; ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div id="syarat_error" class="form-warning"></div>
                        </div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-green">DAFTAR</i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/calendar.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/form-daftar.js'); ?>"></script>
</body>

</html>