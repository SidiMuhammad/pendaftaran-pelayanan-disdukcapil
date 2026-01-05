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
                                    <span>Bagian Layanan</span>
                                    <div class="sort-arrow">
                                        <i class="fa-solid fa-sort-up"></i>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                Deskripsi
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($layanan as $key => $value) : ?>
                            <tr>
                                <td><?= $value['id_layanan']; ?></td>
                                <td><?= $value['nama_layanan']; ?></td>
                                <td><?= $value['bagian_pelayanan']; ?></td>
                                <td class="td-description"><?= $value['deskripsi_layanan']; ?></td>
                                <td>
                                    <div class="table-opt-dropdown">
                                        <a class="ellipsis">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <div class="card dropdown-menu table-opt">
                                            <ul>
                                                <li>
                                                    <a href="<?= base_url('operator/detail_layanan/?id=' . $value['id_layanan']); ?>">
                                                        <i class="fa-solid fa-eye"></i>
                                                        Detail
                                                    </a>
                                                    <a href="<?= base_url('operator/ubah_layanan/?id=' . $value['id_layanan']); ?>">
                                                        <i class="fa-solid fa-pen"></i>
                                                        Ubah
                                                    </a>
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