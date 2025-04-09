<div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-dark text-center fs-4 fw-medium">
                    Lupa Password
                </div>
                <div class="card-body">
                    <form id="forgotForm" action="<?= BASEURL ?>/auth/forgotpasswordsent" method="POST">
                        <div class="mb-3">
                            Kami akan mengirimkan link untuk Reset Password anda ke Email anda di bawah ini.
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" required autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start mt-2">
                                Sudah punya akun? <a href="<?= BASEURL ?>/auth">Login</a>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success" type="submit">Kirim Email</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>