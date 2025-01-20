<div class="container">
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#formModal">
        Buat Tiket
    </button>
    <h3 class="text-center mb-3">Tiket Saya</h3>
    <!-- Table -->
    <table class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th scope="col">Tanggal Dibuat</th>
                <th scope="col">Subjek</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['ticket']): ?>
                <?php foreach ($data['ticket'] as $ticket): ?>
                    <tr>
                        <td scope="row"><?= $ticket['created_at'] ?></td>
                        <td><?= $ticket['subjek'] ?></td>
                        <td><?= ticket_status($ticket['status']) ?></td>
                        <td>
                            <?php if ($ticket['status'] == 1): ?>
                                <button class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    data-fullname="<?= $data['user']['fullname'] ?>"
                                    data-user_id="<?= $ticket['user_id'] ?>"
                                    data-subject="<?= $ticket['subjek'] ?>"
                                    data-description="<?= $ticket['deskripsi'] ?>"
                                    data-ticketNumber="<?= $ticket['nomor_tiket'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger" onclick="showConfirmationDelete('<?= $ticket['nomor_tiket'] ?>')"><i class="bi bi-trash"></i></button>
                                <button class="btn btn-success" onclick="showConfirmationSend('<?= $ticket['nomor_tiket'] ?>')"><i class="bi bi-send"></i></button>
                            <?php endif ?>
                            <?php if ($ticket['status'] == 2): ?>
                            <?php endif ?>
                            <?php if ($ticket['status'] > 1): ?>
                                <button class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#infoModal"
                                    data-fullname="<?= $data['user']['fullname'] ?>"
                                    data-subject="<?= $ticket['subjek'] ?>"
                                    data-description="<?= $ticket['deskripsi'] ?>">
                                    <i class="bi bi-eye"></i>
                                </button>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Create Ticket -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formModalLabel">Buat Tiket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/ticket/tambah" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $data['user']['fullname'] ?>" disabled>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $data['user']['id'] ?>">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="status" name="status" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Ticket -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Tiket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="fullname-edit" name="name" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subjek</label>
                        <input type="text" class="form-control" id="subject-edit" name="subject">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description-edit" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Info Ticket -->
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