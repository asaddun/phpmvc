<?php
require_once '../app/core/AuthCheck.php';
?>
<div class="container">
    <h3 class="text-center mb-3">Buat Laporan Problem</h3>
    <form action="<?= BASEURL; ?>/problem/tambah" method="POST" class="col-md-6 mx-auto">
        <div class="mb-3">
            <label for="mesin" class="form-label">Mesin</label>
            <select name="mesin" id="mesin" class="form-select">
                <option value="" disabled selected>Pilih Mesin</option>
                <?php foreach ($data['mesin'] as $mesin) : ?>
                    <option value="<?= $mesin['asset_id'] ?>">Mesin <?= $mesin['value'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Masalah:</label>
            <textarea name="description" id="description" class="form-control" rows="5" require><?= isset($_SESSION['description']) ? htmlspecialchars($_SESSION['description']) : '' ?></textarea>
            <input type="hidden" id="user_id" name="user_id" value="<?= $data['user']['id'] ?>">
            <input type="hidden" id="status" name="status" value="1">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Buat</button>
        </div>
    </form>
</div>