<div class="app-container">
    <div class="ticket-grid">
        <?php foreach ($antrian as $key_1 => $value_1) : ?>
            <div class="card card-item">
                <div class="ticket-header">
                    <div class="title">No Antrian</div>
                    <div class="number"><?= $value_1['nomor_antrian']; ?></div>
                </div>
                <div class="ticket-info-container">
                    <div>
                        <div class="ticket-title">Nama Pemohon</div>
                        <div class="ticket-content"><?= $value_1['nama_pengguna']; ?></div>
                    </div>
                    <div>
                        <div class="ticket-title">Email Pemohon</div>
                        <div class="ticket-content"><?= $value_1['email_pengguna']; ?></div>
                    </div>
                    <div>
                        <div class="ticket-title">Tanggal Pelayanan</div>
                        <div class="ticket-content"><?= $value_1['tanggal_pelayanan']; ?></div>
                    </div>
                    <div>
                        <div class="ticket-title">Status Antrian</div>
                        <?php if ($value_1['status_antrian'] == 'daftar success') : ?>
                            <div class="ticket-content"><?= 'Menunggu pengecekan' ?></div>
                        <?php elseif ($value_1['status_antrian'] == 'cek success' && !$value_1['operator_layan']) : ?>
                            <div class="ticket-content"><?= 'Menunggu panggilan nomor antrian' ?></div>
                        <?php elseif ($value_1['status_antrian'] == 'cek fail') : ?>
                            <div class="ticket-content"><?= 'Pelayanan tertunda, syarat tidak lengkap' ?></div>
                        <?php elseif ($value_1['status_antrian'] == 'layan fail') : ?>
                            <div class="ticket-content"><?= 'Pemrosesan tertunda, biodata tidak sinkron' ?></div>
                        <?php elseif ($value_1['status_antrian'] == 'layan success') : ?>
                            <div class="ticket-content"><?= 'Menunggu pemrosesan dokumen' ?></div>
                        <?php elseif ($value_1['status_antrian'] == 'mulai proses') : ?>
                            <div class="ticket-content"><?= 'Dokumen pelayanan sedang diproses' ?></div>
                        <?php elseif ($value_1['status_antrian'] == 'selesai proses') : ?>
                            <div class="ticket-content"><?= 'Dokumen pelayanan selesai diproses' ?></div>
                        <?php elseif ($value_1['operator_layan']) : ?>
                            <div class="ticket-content"><?= 'Pelayanan sedang berjalan' ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="ticket-pelayanan-container">
                    <?php foreach ($value_1['pelayanan'] as $key_2 => $value_2) : ?>
                        <div class="pelayanan-info">
                            <?php if ($value_2['status_cek'] == 0) : ?>
                                <div class="jenis-pelayanan btn-gray-light"><?= $value_2['nama_layanan']; ?></div>
                            <?php elseif ($value_2['status_cek'] == 1 || $value_2['status_layan'] == 1) : ?>
                                <div class="jenis-pelayanan btn-red-light"><?= $value_2['nama_layanan']; ?></div>
                            <?php elseif ($value_2['status_cek'] == 2 || $value_2['status_layan'] == 2) : ?>
                                <div class="jenis-pelayanan btn-green-light"><?= $value_2['nama_layanan']; ?></div>
                            <?php endif ?>
                            <div class="pelayanan-status">
                                <div class="ticket-title">Status</div>
                                <div class="ticket-title">:</div>
                                <?php if ($value_2['status_cek'] == 0) : ?>
                                    <div class="ticket-content">Menunggu pengecekan</div>
                                <?php elseif ($value_2['selesai_proses']) : ?>
                                    <div class="ticket-content">Dokumen pelayanan selesai diproses</div>
                                <?php elseif ($value_2['mulai_proses']) : ?>
                                    <div class="ticket-content">Dokumen pelayanan sedang diproses</div>
                                <?php elseif ($value_2['status_layan'] == 1) : ?>
                                    <div class="ticket-content">Pemrosesan tertunda, biodata tidak sinkron</div>
                                <?php elseif ($value_2['status_layan'] == 2) : ?>
                                    <div class="ticket-content">Menunggu pemrosesan</div>
                                <?php elseif ($value_2['status_cek'] == 1) : ?>
                                    <div class="ticket-content">Pelayanan tertunda, syarat kurang</div>
                                <?php elseif ($value_2['status_cek'] == 2) : ?>
                                    <div class="ticket-content">Syarat lengkap</div>
                                <?php elseif ($value_1['operator_layan']) : ?>
                                    <div class="ticket-content">Pelayanan sedang berjalan</div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-option">
                    <a class="btn btn-green" href="<?= base_url('detail_antrian/?id=' . $value_1['id_antrian']); ?>">DETAIL</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
</body>