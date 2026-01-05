<div class="app">
    <div class="wrapper">
        <div class="card auth p-2">
            <h2 class="mb-1">Login Operator</h2>
            <p class="mb-2">Silahkan login untuk dapat mengakses sebagai operator</p>
            <form id="auth_form" method="POST" action="<?= base_url('operator/login/validation'); ?>">
                <div class="mb-1">
                    <label class="form-label">Nama Operator</label>
                    <div class="input-group">
                        <input id="name" name="name" type="text" class="form-input" placeholder="Nama Operator">
                    </div>
                    <div id="name_error" class="form-warning"></div>
                </div>
                <div class="mb-2">
                    <label class="form-label">Kata Sandi</label>
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
        </div>
    </div>
</div>