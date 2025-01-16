<?php
require_once '../app/core/AuthCheck.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Button Modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#formModal">
                Tambah Data Employee
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="mb-3">Daftar Employee</h3>
            <form action="<?= BASEURL; ?>/employee/search" method="POST">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Cari Employee.." name="keyword" id="keyword">
                    <button class="btn btn-outline-secondary" type="submit" id="cariButton">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <?php foreach ($data['emp'] as $emp): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $emp['nama']; ?>
                        <a href="<?= BASEURL ?>/employee/detail/<?= $emp['id']; ?>" class="btn btn-primary">Detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formModalLabel">Form Tambah Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/employee/tambah" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="formNomor" class="form-label">Nomor</label>
                        <input type="text" inputmode="numeric" pattern="\d*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" id="number" name="number">
                    </div>
                    <div class="mb-3">
                        <label for="formEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="formPekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="position" name="position">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>