<style>
    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        /* Menampilkan maksimal 3 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="container">
    <h3 class="text-center mb-4">Daftar Masalah yang Belum Selesai</h3>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
        <?php foreach ($data['problem'] as $problem): ?>
            <div class="col">
                <div class="card text-center">
                    <h5 class="card-header">Mesin <?= $problem['value'] ?></h5>
                    <div class="card-body" style="min-height: 200px;">
                        <p class="card-title">Masalah:</p>
                        <p class="card-text" style="min-height: 80px;"><?= $problem['deskripsi'] ?>.</p>
                        <?php if ($data['user']['level'] == 2): ?>
                            <a href="#" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#problemProcessModal"
                                data-subject="<?= $problem['value'] ?>"
                                data-description="<?= $problem['deskripsi'] ?>"
                                data-status="<?= $problem['status'] ?>">
                                <i class="fa-solid fa-eye"></i> Lihat
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        Dari: <br><?= $problem['waktu_mulai'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../app/views/problem/modals_problem.php' ?>