<div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center fs-5">
                    Lupa Password
                </div>
                <div class="card-body">
                    <form id="forgotForm" action="<?= BASEURL ?>/auth/forgotpasswordsent" method="POST">
                        <div class="mb-3">
                            Kami akan mengirimkan form untuk Reset Password anda ke Email anda di bawah ini.
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
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