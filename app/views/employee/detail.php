<div class="container d-flex justify-content-center align-items-center">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= $data['emp']['nama']; ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $data['emp']['nomor']; ?></h6>
            <p class="card-text mt-3"><?= $data['emp']['pekerjaan']; ?></p>
            <p class="card-text"><?= $data['emp']['email']; ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= BASEURL ?>/employee" class="btn btn-primary">Kembali</a>
                <button data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-warning">Edit</button>
                <button onclick="deleteButton()" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formModalLabel">Edit Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/employee/edit/<?= $data['emp']['id'] ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $data['emp']['nama']; ?>">
                    </div>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['emp']['id']; ?>">
                    <div class="mb-3">
                        <label for="formNomor" class="form-label">Nomor</label>
                        <input type="text" inputmode="numeric" pattern="\d*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" id="number" name="number" value="<?= $data['emp']['nomor']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="formEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $data['emp']['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="formPekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?= $data['emp']['pekerjaan']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function deleteButton() {
        Swal.fire({
            title: "Hapus data?",
            text: "Kamu tidak akan bisa mengembalikannya lagi!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            confirmButtonColor: "#d33"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= BASEURL ?>/employee/hapus/<?= $data['emp']['id'] ?>"
            }
        });
    }
</script>