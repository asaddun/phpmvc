<div class="container">
    <h3 class="text-center mb-3">Riwayat Tiket</h3>
    <!-- Table -->
    <table class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th scope="col">Tanggal Dibuat</th>
                <th scope="col">Dari</th>
                <th scope="col">Subjek</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['ticket'] as $ticket): ?>
                <tr>
                    <td scope="row"><?= $ticket['created_at'] ?></td>
                    <td><?= $ticket['fullname'] ?></td>
                    <td><?= $ticket['subjek'] ?></td>
                    <td><?= ticket_status($ticket['status']) ?></td>
                    <td>
                        <button class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#infoModal"
                            data-fullname="<?= $ticket['fullname'] ?>"
                            data-subject="<?= $ticket['subjek'] ?>"
                            data-description="<?= $ticket['deskripsi'] ?>">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="infoModalLabel">Info Tiket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <div class="form-control"><span id="fullname-info"></span></div>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subjek</label>
                    <div class="form-control"><span id="subject-info"></span></div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <div class="form-control"><span id="description-info"></span></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
</script>