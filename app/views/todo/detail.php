<div class="container d-flex justify-content-center align-items-center">
    <div class="card" style="width: 18rem;">
        <?php
        $status = ($data['todo']['status'] > 0) ?
            ["Selesai", "bg-success", "checked"] :
            ["Belum selesai", "", ""];
        ?>
        <h5 class="card-header <?= $status[1]; ?> text-center"><?= $status[0]; ?></h5>
        <div class="card-body">
            <h5 class="card-title"><?= $data['todo']['title']; ?></h5>
            <p class="card-text"><?= $data['todo']['deskripsi']; ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= BASEURL ?>/todo" class="btn btn-primary">Kembali</a>
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
                <h1 class="modal-title fs-5" id="formModalLabel">Edit Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/todo/edit/<?= $data['todo']['id'] ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $data['todo']['judul']; ?>">
                    </div>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['todo']['id']; ?>">
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= $data['todo']['deskripsi']; ?>">
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" <?= $status[2]; ?> id="status" name="status" value="1">
                        <label class="form-check-label" for="status">
                            Sudah Selesai?
                        </label>
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
                window.location.href = "<?= BASEURL ?>/todo/hapus/<?= $data['todo']['id'] ?>"
            }
        });
    }
</script>