<div class="app">
    <div class="wrapper">
        <div class="card auth p-2 m-2">
            <h2 class="mb-1"><?= $title; ?></h2>
            <p class="mb-2">Silahkan mengisi nama pengguna, email dan kata sandi terlebih dahulu</p>
            <form id="auth_form" method="POST" action="<?= base_url('register/validation'); ?>">
                <div class="mb-1">
                    <label class="form-label" for="name">Nama Pengguna</label>
                    <div class="input-group">
                        <input id="name" name="name" type="text" class="form-input" placeholder="Nama Pengguna">
                    </div>
                    <div id="name_error" class="form-warning"></div>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group">
                        <input id="email" name="email" type="text" class="form-input" placeholder="Email">
                    </div>
                    <div id="email_error" class="form-warning"></div>
                </div>
                <div class="mb-2">
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
                <button type="submit" class="btn-primary  mb-2">BUAT AKUN</button>
            </form>
            <p>
                <span>
                    Sudah memiliki akun?
                </span>
                <a href="<?= base_url('login'); ?>">
                    <span>Login disini</span>
                </a>
            </p>
        </div>
    </div>
</div>