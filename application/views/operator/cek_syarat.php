<div class="app-container">
    <div class="card">
        <div class="card-header">
            <h2><?= $menu; ?></h2>
        </div>
        <div class="card-body">
            <form id="form_cek" method="POST" action="<?= base_url('operator/cek_syarat/validation'); ?>">
                <input type="hidden" name="id_antrian" value="<?= $antrian['id_antrian']; ?>">
                <div class="form-grid-daftar">
                    <div>
                        <label class="form-label">Periksa Kelengkapan Dokumen</label>
                        <div class="mb-2">
                            <div class="checkbox-input-container-syarat">
                                <?php foreach ($pelayanan as $key_1 => $value_1) : ?>
                                    <div class="list-container-syarat open">
                                        <label><?= $value_1['nama_layanan']; ?></label>
                                        <ul>
                                            <?php foreach ($value_1['cek_syarat'] as $key_2 => $value_2) : ?>
                                                <li>
                                                    <input id="cek_<?= $value_2['id_cek']; ?>" name="cek[<?= $value_1['id_pelayanan']; ?>][<?= $value_2['id_cek']; ?>]" type="checkbox" value="<?= $value_2['status_lengkap']; ?>" <?php if ($value_2['status_lengkap'] == 1) echo 'checked'; ?>>
                                                    <label class="label-checkbox-syarat cek" for="cek_<?= $value_2['id_cek']; ?>">
                                                        <i class="fa-solid fa-square-xmark"></i><i class="fa-solid fa-square-check"></i>
                                                        <?= $value_2['nama_syarat']; ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <label class="form-label" for="keterangan_<?= $value_1['id_pelayanan']; ?>">Keterangan Pengecekan</label>
                                        <div class="input-keterangan">
                                            <textarea id="keterangan_<?= $value_1['id_pelayanan']; ?>" name="keterangan[<?= $value_1['id_pelayanan']; ?>]" cols="1" rows="2" class="form-input" placeholder="Keterangan Pengecekan"><?= $value_1['keterangan_cek']; ?></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Data Antrian</label>
                        <div class="info-antrian-container">
                            <table class="table-info">
                                <tbody>
                                    <tr>
                                        <td>No Antrian</td>
                                        <td class="spacer">:</td>
                                        <td><?= $antrian['nomor_antrian']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ID Antrian</td>
                                        <td class="spacer">:</td>
                                        <td><?= $antrian['id_antrian']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pemohon</td>
                                        <td class="spacer">:</td>
                                        <td><?= $antrian['nama_pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Pemohon</td>
                                        <td class="spacer">:</td>
                                        <td><?= $antrian['email_pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ID Pemohon</td>
                                        <td class="spacer">:</td>
                                        <td><?= $antrian['id_pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pelayanan</td>
                                        <td class="spacer">:</td>
                                        <td><?= $antrian['tanggal_pelayanan']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-green">SELESAI</i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/form-cek.js'); ?>"></script>
</body>

</html>