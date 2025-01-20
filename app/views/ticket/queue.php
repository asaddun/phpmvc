<div class="container">
    <h3 class="text-center mb-3">Antrian Tiket</h3>
    <!-- Table -->
    <table class="table table-sm table-hover text-center">
        <thead>
            <tr>
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
                        <td scope="row"><?= $ticket['queued_at'] ?></td>
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
                    <td colspan="4">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Process Ticket -->
<div class="modal fade" id="processModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="processModalLabel">Info Tiket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <div class="form-control"><span id="fullname-process"></span></div>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subjek</label>
                    <div class="form-control"><span id="subject-process"></span></div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <div class="form-control"><span id="description-process"></span></div>
                </div>
                <div id="action-area" class="d-none">
                    <hr>
                    <div class="mb-3">
                        <label for="action-textarea" class="form-label">Tindakan Teknisi</label>
                        <textarea name="action" id="action-textarea" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php if ($data['user']['level'] == 2): ?>
                    <form id="form-process" method="POST">
                        <button id="processButton" type="submit" class="btn btn-success d-none" data-bs-dismiss="modal">Process</button>
                    </form>
                    <form id="form-hold" method="POST">
                        <button id="holdButton" type="submit" class="btn btn-secondary d-none" data-bs-dismiss="modal">Hold</button>
                    </form>
                    <form id="form-close" method="POST">
                        <button id="closeButton" type="submit" class="btn btn-success d-none" data-bs-dismiss="modal">Done</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<script>

</script>