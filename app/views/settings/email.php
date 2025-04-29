<div class="container">
    <h3 class="mb-5">Settings - Ubah Email</h3>
    <div class="row">
        <div class="col-md-3 mb-5">
            <div class="list-group">
                <?php
                require_once '../app/views/components/settings-sidebar.php';
                ?>
            </div>
        </div>
        <div class="p-4 col bg-white border">
            <div class="fs-5">Email:
                <div class="fs-6">
                    <?= $data['email'] ?>
                </div>
            </div>
            <br>
            <form id="emailForm" action="<?= BASEURL ?>/settings/changeemail" method="POST" class="w-50">
                <div class="mb-3">
                    <label for="email" class="form-label fs-5">Ubah Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= $data['email'] ?>">
                </div>
                <button class="btn btn-success" type="submit">Perbarui</button>
            </form>
        </div>
    </div>
</div>
<div>
    <?php Swal::swal(); ?>
</div>