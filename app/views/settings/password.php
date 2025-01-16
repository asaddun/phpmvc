<div class="container">
    <h3 class="mb-5">Reset Password</h3>
    <div class="row">
        <div class="col-md-3 mb-5">
            <div class="list-group">
                <?php
                require_once '../app/views/components/settings-sidebar.php';
                ?>
            </div>
        </div>
        <div class="p-4 col bg-white border">
            <div class="fs-5">Password:
                <div class="fs-6">
                    ********
                </div>
            </div>
            <br>
            <form id="passwordForm" action="#" method="POST" class="w-50">
                <div class="mb-3">
                    <label for="password" class="form-label fs-5">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fs-5">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>
                <button class="btn btn-success" type="submit">Reset</button>
            </form>
        </div>
    </div>
</div>
<div>
    <?php Swal::swal(); ?>
</div>