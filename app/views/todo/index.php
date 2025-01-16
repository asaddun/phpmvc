<?php
require_once '../app/core/AuthCheck.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Button Modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#formModal">
                Tambah Tugas
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="mb-3">Daftar Tugas</h3>
            <!-- Form cari -->
            <form action="<?= BASEURL; ?>/todo/cari" method="POST">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Cari tugas.." name="keyword" id="keyword">
                    <button class="btn btn-outline-secondary" type="submit" id="cariButton">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <!-- List hasil data -->
            <ul class="list-group">
                <?php foreach ($data['todo'] as $todo) : ?>
                    <?php
                    $status = ($todo['status'] > 0) ?
                        ["text-decoration-line-through", '<i class="fa-regular fa-circle-check"></i>'] :
                        ["", ""];
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold fs-4 <?= $status[0]; ?>"><?= $todo['title']; ?><?= $status[1]; ?></div>
                            <?= $todo['deskripsi']; ?>
                        </div>
                        <a href="<?= BASEURL ?>/todo/detail/<?= $todo['id']; ?>" class="btn btn-primary">Detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formModalLabel">Form Tambah Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/todo/tambah" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <input type="hidden" class="form-control" id="status" name="status" value="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>