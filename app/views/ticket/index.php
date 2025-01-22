<?php
require_once '../app/core/AuthCheck.php';
?>
<div class="container">
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#formModal">
        Buat Tiket
    </button>
    <h3 class="text-center mb-3">Tiket Saya</h3>
    <!-- Table -->
    <table class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th scope="col">Nomor Tiket</th>
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
                        <td scope="row"><?= $ticket['nomor_tiket'] ?></td>
                        <td><?= $ticket['created_at'] ?></td>
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
                                    data-description="<?= $ticket['deskripsi'] ?>"
                                    data-status="<?= $ticket['status'] ?>"
                                    data-action="<?= $ticket['tindakan'] ?>"
                                    data-ticketNumber="<?= $ticket['nomor_tiket'] ?>">
                                    <i class="bi bi-eye"></i>
                                </button>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/ticket/modals_ticket.php' ?>