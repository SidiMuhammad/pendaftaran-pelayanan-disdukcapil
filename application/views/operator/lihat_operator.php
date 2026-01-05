<div class="modal-container">
    <div class="card modal-card">
        <div class="modal-header">
            <span>Hapus Operator</span>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-button">
            <a class="btn btn-gray batal">BATAL</a>
            <a class="btn btn-red hapus" href="">HAPUS</a>
        </div>
    </div>
</div>
<div class="app-container">
    <div class="card">
        <div class="card-header">
            <h2>Tabel Operator</h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <div class="th-content">
                                    <span>ID</span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Nama</span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Peran</span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Dibuat Oleh</span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Waktu Dibuat</span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operator as $key => $value) : ?>
                            <tr>
                                <td><?= $value['id_operator']; ?></td>
                                <td><?= $value['nama_operator']; ?></td>
                                <td>
                                    <?= $value['peran_operator']; ?>
                                    <?php if ($value['peran_operator'] == 'Operator Pelayanan') : ?>
                                        - <?= $value['meja_operator']; ?>
                                    <?php endif ?>
                                </td>
                                <td><?= $value['dibuat_oleh']; ?></td>
                                <td><?= $value['tanggal_dibuat']; ?></td>
                                <td>
                                    <div class="table-opt-dropdown">
                                        <a class="ellipsis">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="card dropdown-menu table-opt">
                                            <ul>
                                                <li>
                                                    <a href="<?= base_url('operator/ubah_operator/?id=' . $value['id_operator']); ?>">
                                                        <i class="fa-solid fa-pen"></i>
                                                        Ubah
                                                    </a>
                                                    <!-- <?php if ($value['nama_operator'] != $name) : ?>
                                                        <a class="table-data-hapus" href="<?= base_url('operator/hapus_operator/?id=' . $value['id_operator']); ?>" data-id="<?= $value['id_operator']; ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                            Hapus
                                                        </a>
                                                    <?php endif ?> -->
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