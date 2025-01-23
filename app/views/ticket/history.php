<div class="container">
    <h3 class="text-center mb-3">Riwayat Tiket</h3>
    <!-- Table -->
    <table class="table table-sm table-hover text-center">
        <thead>
            <tr>
                <th scope="col" class="d-none d-md-table-cell">Nomor Tiket</th>
                <th scope="col">Tanggal Dibuat</th>
                <th scope="col">Dari</th>
                <th scope="col">Subjek</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['ticket']): ?>
                <?php foreach ($data['ticket'] as $ticket): ?>
                    <tr>
                        <td scope="row" class="d-none d-md-table-cell"><?= $ticket['nomor_tiket'] ?></td>
                        <td><?= $ticket['created_at'] ?></td>
                        <td><?= $ticket['fullname'] ?></td>
                        <td><?= $ticket['subjek'] ?></td>
                        <td><?= ticket_status($ticket['status']) ?></td>
                        <td>
                            <button class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#infoModal"
                                data-fullname="<?= $ticket['fullname'] ?>"
                                data-subject="<?= $ticket['subjek'] ?>"
                                data-description="<?= $ticket['deskripsi'] ?>"
                                data-status="<?= $ticket['status'] ?>"
                                data-action="<?= $ticket['tindakan'] ?>"
                                data-ticketNumber="<?= $ticket['nomor_tiket'] ?>">
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