<?php
require_once '../app/core/AuthCheck.php';
?>
<div class="container">
    <h3 class="text-center mb-3">Antrian Tiket</h3>
    <!-- Table -->
    <table class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th scope="col">Nomor Tiket</th>
                <th scope="col">Tanggal Antri</th>
                <th scope="col">Dari</th>
                <th scope="col">Subjek</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['ticket']): ?>
                <?php foreach ($data['ticket'] as $ticket): ?>
                    <tr class="<?= ($ticket['status'] == 4) ? 'table-danger' : '' ?>">
                        <td scope="row"><?= $ticket['nomor_tiket'] ?></td>
                        <td><?= $ticket['queued_at'] ?></td>
                        <td><?= $ticket['fullname'] ?></td>
                        <td><?= $ticket['subjek'] ?></td>
                        <td><?= ticket_status($ticket['status']) ?></td>
                        <td>
                            <?php if (($ticket['username'] == $_SESSION['username']) && ($ticket['status'] == 2)): ?>
                                <button class="btn btn-danger" onclick="showConfirmationCancel('<?= $ticket['nomor_tiket'] ?>')"><i class="bi bi-x-lg"></i></button>
                            <?php endif; ?>
                            <button class="btn btn-success"
                                data-bs-toggle="modal" data-bs-target="#processModal"
                                data-fullname="<?= $ticket['fullname'] ?>"
                                data-subject="<?= $ticket['subjek'] ?>"
                                data-description="<?= $ticket['deskripsi'] ?>"
                                data-username="<?= $ticket['username'] ?>"
                                data-status="<?= $ticket['status'] ?>"
                                data-ticketNumber="<?= $ticket['nomor_tiket'] ?>"
                                data-action="<?= $ticket['tindakan'] ?>">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/ticket/modals_ticket.php' ?>