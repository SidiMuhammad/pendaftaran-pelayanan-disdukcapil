<div class="app-container">
    <div class="card">
        <div class="card-header">
            <h2>Tambah Operator</h2>
        </div>
        <div class="card-body">
            <form id="form_tambah_operator" method="POST" action="<?= base_url('operator/tambah_operator/validation'); ?>">
                <div class="form-grid-daftar">
                    <div>
                        <label class="form-label" for="name">Nama Operator</label>
                        <div class="input-group">
                            <input id="name" name="name" type="text" class="form-input" placeholder="Nama Operator">
                        </div>
                        <div id="name_error" class="form-warning"></div>
                    </div>
                    <div>
                        <div class="content-between">
                            <label class="form-label" for="password">Kata Sandi</label>
                        </div>
                        <div class="input-group">
                            <input id="password" name="password" type="password" class="form-input input-icon" placeholder="Kata Sandi">
                            <div class="icon-container">
                                <i class="fa-solid fa-eye-slash cursor-pointer toggle-visible"></i>
                            </div>
                        </div>
                        <div id="password_error" class="form-warning"></div>
                    </div>
                    <div>
                        <label class="form-label">Peran Operator</label>
                        <div class="radio-input-container">
                            <input id="operator_pengecekan" name="role" type="radio" value="Operator Pengecekan">
                            <label class="label-radio" for="operator_pengecekan">
                                <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Operator Pengecekan
                            </label>
                            <input id="operator_pelayanan" name="role" type="radio" value="Operator Pelayanan" checked>
                            <label class="label-radio" for="operator_pelayanan">
                                <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Operator Pelayanan
                            </label>
                            <input id="operator_pemrosesan" name="role" type="radio" value="Operator Pemrosesan">
                            <label class="label-radio" for="operator_pemrosesan">
                                <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Operator Pemrosesan
                            </label>
                            <input id="admin" name="role" type="radio" value="Administrator">
                            <label class="label-radio" for="admin">
                                <i class="fa-regular fa-circle"></i><i class="fa-solid fa-circle-dot"></i>Administrator
                            </label>
                        </div>
                        <div id="role_error" class="form-warning"></div>
                    </div>
                    <div>
                        <label class="form-label" for="meja">Nomor Meja Pelayanan</label>
                        <div class="input-group">
                            <input id="meja" name="meja" type="text" class="form-input" placeholder="Nomor Meja Pelayanan">
                        </div>
                        <div id="meja_error" class="form-warning"></div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-green">TAMBAH OPERATOR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.6.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/header.js'); ?>"></script>
<script type="application/javascript" src="<?= base_url('assets /js/form-tambah-operator.js'); ?>"></script>
</body>

</html>