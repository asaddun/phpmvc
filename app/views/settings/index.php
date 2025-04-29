<div class="container">
    <h3 class="mb-5">Settings - Informasi</h3>
    <div class="row">
        <div class="col-md-3 mb-5">
            <div class="list-group">
                <?php
                require_once '../app/views/components/settings-sidebar.php';
                ?>
            </div>
        </div>
        <div class="p-4 col bg-white border">
            <div class="fs-5">Username:
                <div class="fs-6">
                    <?= $_SESSION['username'] ?>
                </div>
            </div>
            <br>
            <div class="fs-5">Email:
                <div class="fs-6">
                    <?= $data['email'] ?>
                    <br>
                    <a href="<?= BASEURL ?>/settings/email">Edit</a>
                </div>
            </div>
            <br>
            <div class="fs-5">Password:
                <div class="fs-6">
                    *********
                    <br>
                    <a href="<?= BASEURL ?>/settings/password">Edit</a>
                </div>
            </div>
            <br>
            <div class="fs-5">Hapus Akun:
                <div class="fs-6">
                    <form id="delete-account-form" action="#" method="POST">
                    </form>
                    <button type="button" id="delete-account-button" class="btn btn-danger">Hapus Akun</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <?php Swal::swal(); ?>
</div>