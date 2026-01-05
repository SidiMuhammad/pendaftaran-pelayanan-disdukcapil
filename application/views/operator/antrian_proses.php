<div class="app-container">
    <div class="card mb-2">
        <div class="card-header">
            <h2><?= $menu; ?></h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <div class="th-content">
                                    <span>
                                        Antrian
                                    </span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>
                                        Pemohon
                                    </span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>
                                        Tanggal Pelayanan
                                    </span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>
                                        Status Pelayanan
                                    </span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                Pelayanan
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($antrian as $key_1 => $value_1) : ?>
                            <tr>
                                <td>
                                    <div class="data-container">
                                        <span class="data-type">
                                            <div>no</div>
                                            <div>id</div>
                                        </span>
                                        <span>
                                            <div class="data-value-large"><?= $value_1['nomor_antrian']; ?></div>
                                            <div><?= $value_1['id_antrian']; ?></div>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="data-container">
                                        <span class="data-type">
                                            <div>nama</div>
                                            <div>email</div>
                                            <div>id</div>
                                        </span>
                                        <span>
                                            <div><?= $value_1['nama_pengguna']; ?></div>
                                            <div><?= $value_1['email_pengguna']; ?></div>
                                            <div><?= $value_1['id_pengguna']; ?></div>
                                        </span>
                                    </div>
                                </td>
                                <td><?= $value_1['tanggal_pelayanan']; ?></td>
                                <td>
                                    <?php if ($value_1['status_antrian'] == 'daftar success') : ?>
                                        <?= 'menunggu pengecekan' ?>
                                    <?php elseif ($value_1['status_antrian'] == 'cek success') : ?>
                                        <?= 'menunggu panggilan nomor antrian' ?>
                                    <?php elseif ($value_1['status_antrian'] == 'cek fail') : ?>
                                        <?= 'pelayanan tertunda, syarat tidak lengkap' ?>
                                    <?php elseif ($value_1['status_antrian'] == 'layan success') : ?>
                                        <?= 'menunggu pemrosesan' ?>
                                    <?php elseif ($value_1['status_antrian'] == 'layan fail') : ?>
                                        <?= 'pemrosesan tertunda, data tidak sinkron' ?>
                                    <?php elseif ($value_1['status_antrian'] == 'mulai proses') : ?>
                                        <?= 'dokumen pelayanan sedang diproses' ?>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <div class="data-pelayanan-container">
                                        <div class="jenis-pelayanan btn-green-light"><?= $value_1['nama_layanan']; ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-opt-dropdown">
                                        <a class="ellipsis">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="card dropdown-menu table-opt">
                                            <ul>
                                                <li>
                                                    <a href="<?= base_url('operator/detail_antrian/?id_antrian=' . $value_1['id_antrian'] . '&id_pengguna=' . $value_1['id_pengguna']); ?>">Detail Antrian</a>
                                                    <?php if (!$value_1['mulai_proses']) : ?>
                                                        <a href="<?= base_url('operator/pemrosesan/?id_pelayanan=' . $value_1['id_pelayanan'] . '&id_antrian=' . $value_1['id_antrian']); ?>">Mulai Pemrosesan</a>
                                                    <?php elseif ($value_1['mulai_proses']) : ?>
                                                        <a href="<?= base_url('operator/pemrosesan/selesai/?id_pelayanan=' . $value_1['id_pelayanan'] . '&id_antrian=' . $value_1['id_antrian']); ?>">Selesai Pemrosesan</a>
                                                    <?php endif ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/table.js'); ?>"></script>
</body>

</html>