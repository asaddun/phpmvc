<div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center fs-5">
                    Selamat Datang di Websiteku
                </div>
                <div class="card-body">
                    <?php
                    $redirect = isset($data['redirect']) ? '/' . $data['redirect'] : '';
                    ?>
                    <form id="loginForm" action="<?= BASEURL ?>/auth/signin<?= $redirect ?>" method="POST">
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_SESSION['formData']['username']) ? htmlspecialchars($_SESSION['formData']['username']) : ''; ?>" autofocus>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group mb-2">
                                <input type="password" class="form-control" id="password" name="password">
                                <button class="btn btn-outline-info text-dark" type="button" id="button-addon2" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="icon-password"></i></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 text-end">
                            <a href="<?= BASEURL ?>/auth/forgotpassword">Lupa Password?</a>
                        </div>
                        <div class="row">
                            <div class="col text-start mt-2">
                                Belum punya akun? <a href="<?= BASEURL ?>/auth/signup">Daftar akun</a>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php unset($_SESSION['formData']); ?>