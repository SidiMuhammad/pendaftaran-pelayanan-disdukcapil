<div class="app-container">
    <div class="ticket-grid">
        <div class="card">
            <div class="card-header">
                <h2><?= $menu; ?></h2>
            </div>
            <div class="ticket-info-container">
                <div>
                    <div class="ticket-title">No Antrian</div>
                    <div class="ticket-content"><?= $antrian['nomor_antrian']; ?></div>
                </div>
                <div>
                    <div class="ticket-title">Nama Pemohon</div>
                    <div class="ticket-content"><?= $antrian['nama_pengguna']; ?></div>
                </div>
                <div>
                    <div class="ticket-title">ID Antrian</div>
                    <div class="ticket-content"><?= $antrian['id_antrian']; ?></div>
                </div>
                <div>
                    <div class="ticket-title">Email Pemohon</div>
                    <div class="ticket-content"><?= $antrian['email_pengguna']; ?></div>
                </div>
                <div>
                    <div class="ticket-title">Tanggal Pelayanan</div>
                    <div class="ticket-content"><?= $antrian['tanggal_pelayanan']; ?></div>
                </div>
                <div>
                    <div class="ticket-title">Waktu Pendaftaran</div>
                    <div class="ticket-content"><?= $antrian['tanggal_pendaftaran']; ?></div>
                </div>
                <div>
                    <div class="ticket-title">Status Antrian</div>
                    <div class="ticket-content">
                        <?php if ($antrian['status_antrian'] == 'daftar success') : ?>
                            <?= 'Menunggu pengecekan' ?>
                        <?php elseif ($antrian['status_antrian'] == 'cek success' && !$antrian['operator_layan']) : ?>
                            <?= 'Menunggu panggilan nomor antrian' ?>
                        <?php elseif ($antrian['status_antrian'] == 'cek fail') : ?>
                            <?= 'Pelayanan tertunda, syarat tidak lengkap' ?>
                        <?php elseif ($antrian['status_antrian'] == 'layan fail') : ?>
                            <?= 'Pemrosesan tertunda, biodata tidak sinkron' ?>
                        <?php elseif ($antrian['status_antrian'] == 'layan success') : ?>
                            <?= 'Menunggu pemrosesan dokumen' ?>
                        <?php elseif ($antrian['status_antrian'] == 'mulai proses') : ?>
                            <?= 'Dokumen pelayanan sedang diproses' ?>
                        <?php elseif ($antrian['status_antrian'] == 'selesai proses') : ?>
                            <?= 'Dokumen pelayanan selesai diproses' ?>
                        <?php elseif ($antrian['operator_layan']) : ?>
                            <?= 'Pelayanan sedang berjalan' ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="ticket-pelayanan-container">
                <div class="pelayanan-step-container">
                    <?php if ($antrian['status_antrian'] == 'cek success' || $antrian['status_antrian'] == 'cek fail') : ?>
                        <a class="btn btn-step-pengecekan active">Pengecekan</a>
                    <?php elseif ($antrian['operator_cek']) : ?>
                        <a class="btn btn-step-pengecekan">Pengecekan</a>
                    <?php else : ?>
                        <a class="btn btn-disabled">Pengecekan</a>
                    <?php endif ?>
                    <span class="next<?php echo $antrian['operator_layan'] ? ' active' : ''; ?>"><i class="fa-solid fa-angle-right"></i></span>
                    <?php if ($antrian['status_antrian'] == 'layan success' || $antrian['status_antrian'] == 'layan fail') : ?>
                        <a class="btn btn-step-pelayanan active">Pelayanan</a>
                    <?php elseif ($antrian['operator_layan']) : ?>
                        <a class="btn btn-step-pelayanan">Pelayanan</a>
                    <?php else : ?>
                        <a class="btn btn-disabled">Pelayanan</a>
                    <?php endif ?>
                    <span class="next<?php echo ($antrian['status_antrian'] == 'mulai proses' || $antrian['status_antrian'] == 'selesai proses') ? ' active' : ''; ?>"><i class="fa-solid fa-angle-right"></i></span>
                    <?php if ($antrian['status_antrian'] == 'mulai proses' || $antrian['status_antrian'] == 'selesai proses') : ?>
                        <a class="btn btn-step-pemrosesan active">Pemrosesan</a>
                    <?php else : ?>
                        <a class="btn btn-disabled">Pemrosesan</a>
                    <?php endif ?>
                </div>
                <div class="pelayanan-detail-container<?php echo ($antrian['status_antrian'] == 'daftar success') ? ' open' : ''; ?>">
                    <?php foreach ($antrian['pelayanan'] as $key_2 => $value_2) : ?>
                        <div>
                            <div class="jenis-pelayanan btn-gray-light"><?= $value_2['nama_layanan']; ?></div>
                            <table class="table-info">
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="spacer">:</td>
                                        <td class="ticket-content">Menunggu pengecekan</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="pelayanan-detail-container<?php echo ($antrian['status_antrian'] == 'cek success') ? ' open' : ''; ?>">
                    <?php foreach ($antrian['pelayanan'] as $key_2 => $value_2) : ?>
                        <div>
                            <?php if ($value_2['status_cek'] == 1) : ?>
                                <div class="jenis-pelayanan btn-red-light"><?= $value_2['nama_layanan']; ?></div>
                            <?php elseif ($value_2['status_cek'] == 2) : ?>
                                <div class="jenis-pelayanan btn-green-light"><?= $value_2['nama_layanan']; ?></div>
                            <?php endif ?>
                            <table class="table-info">
                                <tbody>
                                    <tr>
                                        <td>Status Pengecekan</td>
                                        <td class="spacer">:</td>
                                        <?php if ($value_2['status_cek'] == 1) : ?>
                                            <td class="ticket-content">Syarat kurang</td>
                                        <?php elseif ($value_2['status_cek'] == 2) : ?>
                                            <td class="ticket-content">Syarat lengkap</td>
                                        <?php endif ?>
                                    </tr>
                                    <tr>
                                        <td>Keterangan Pengecekan</td>
                                        <td class="spacer">:</td>
                                        <td class="ticket-content"><?php echo $value_2['keterangan_cek'] ? "'" . $value_2['keterangan_cek'] . "'" : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Petugas Pengecekan</td>
                                        <td class="spacer">:</td>
                                        <td class="ticket-content"><?= $antrian['operator_cek']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Selesai Pengecekan</td>
                                        <td class="spacer">:</td>
                                        <td class="ticket-content"><?= $antrian['waktu_selesai_cek']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="pelayanan-detail-container<?php echo ($antrian['status_antrian'] == 'layan success' || $antrian['status_antrian'] == 'layan fail') ? ' open' : ''; ?>">
                    <?php foreach ($antrian['pelayanan'] as $key_2 => $value_2) : ?>
                        <?php if ($value_2['status_cek'] == 2) : ?>
                            <div>
                                <?php if ($value_2['status_layan'] == 1) : ?>
                                    <div class="jenis-pelayanan btn-red-light"><?= $value_2['nama_layanan']; ?></div>
                                <?php elseif ($value_2['status_layan'] == 2) : ?>
                                    <div class="jenis-pelayanan btn-green-light"><?= $value_2['nama_layanan']; ?></div>
                                <?php endif ?>
                                <table class="table-info">
                                    <tbody>
                                        <tr>
                                            <td>Status Pelayanan</td>
                                            <td class="spacer">:</td>
                                            <?php if ($value_2['status_layan'] == 1) : ?>
                                                <td class="ticket-content">Biodata tidak sinkron</td>
                                            <?php elseif ($value_2['status_layan'] == 2) : ?>
                                                <td class="ticket-content">Biodata sinkron</td>
                                            <?php endif ?>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Pelayanan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?php echo $value_2['keterangan_layan'] ? "'" . $value_2['keterangan_layan'] . "'" : '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Petugas Pelayanan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $antrian['operator_layan']['nama_operator']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Meja Pelayanan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $antrian['operator_layan']['meja_operator']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Mulai Pelayanan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $antrian['waktu_mulai_layan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Selesai Pelayanan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $antrian['waktu_selesai_layan']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
                <div class="pelayanan-detail-container<?php echo ($antrian['status_antrian'] == 'mulai proses' || $antrian['status_antrian'] == 'selesai proses') ? ' open' : ''; ?>">
                    <?php foreach ($antrian['pelayanan'] as $key_2 => $value_2) : ?>
                        <?php if ($value_2['status_layan'] == 2) : ?>
                            <div>
                                <div class="jenis-pelayanan btn-green-light"><?= $value_2['nama_layanan']; ?></div>
                                <table class="table-info">
                                    <tbody>
                                        <tr>
                                            <td>Status Pemrosesan</td>
                                            <td class="spacer">:</td>
                                            <?php if ($value_2['selesai_proses']) : ?>
                                                <td class="ticket-content">Dokumen pelayanan selesai diproses</td>
                                            <?php elseif ($value_2['mulai_proses']) : ?>
                                                <td class="ticket-content">Dokumen pelayanan sedang diproses</td>
                                            <?php endif ?>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Pemrosesan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?php echo $value_2['keterangan_layan'] ? "'" . $value_2['keterangan_layan'] . "'" : '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Petugas Pemrosesan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $value_2['operator_proses']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Mulai Pemrosesan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $value_2['mulai_proses']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Selesai Pemrosesan</td>
                                            <td class="spacer">:</td>
                                            <td class="ticket-content"><?= $value_2['selesai_proses']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/detail-antrian.js'); ?>"></script>
</body>