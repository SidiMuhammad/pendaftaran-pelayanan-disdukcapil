<div class="app">
    <div class="wrapper">
        <div class="card auth p-2">
            <h2 class="mb-1">Login</h2>
            <p class="mb-2">Silahkan login untuk dapat mengakses layanan pendaftaran online</p>
            <form id="auth_form" method="POST" action="<?= base_url('login/validation'); ?>">
                <div class="mb-1">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <input id="email" name="email" type="text" class="form-input" placeholder="Email">
                    </div>
                    <div id="email_error" class="form-warning"></div>
                </div>
                <div class="mb-2">
                    <div class="content-between">
                        <label class="form-label">Kata Sandi</label>
                        <a href="">Lupa Kata Sandi?</a>
                    </div>
                    <div class="input-group">
                        <input id="password" name="password" type="password" class="form-input input-icon" placeholder="Kata Sandi">
                        <div class="icon-container">
                            <i class="fa-solid fa-eye-slash cursor-pointer toggle-visible"></i>
                        </div>
                    </div>
                    <div id="password_error" class="form-warning"></div>
                </div>
                <button type="submit" class="btn-primary  mb-2">LOGIN</button>
            </form>
            <p>
                <span>
                    Belum memiliki akun?
                </span>
                <a href="<?= base_url('register'); ?>">
                    <span>Buat akun disini</span>
                </a>
            </p>
        </div>
    </div>
</div>