<!-- Modal Edit Ticket -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel"><span id="ticketnumber-edit"></span></h1>
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
                <h1 class="modal-title fs-5" id="infoModalLabel"><span id="ticketnumber-info"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="fullname-info" class="form-label">Nama</label>
                    <div class="form-control"><span id="fullname-info"></span></div>
                </div>
                <div class="mb-3">
                    <label for="subject-info" class="form-label">Subjek</label>
                    <div class="form-control"><span id="subject-info"></span></div>
                </div>
                <div class="mb-3">
                    <label for="description-info" class="form-label">Deskripsi</label>
                    <div class="form-control"><span id="description-info"></span></div>
                </div>
                <div class="mb-3">
                    <label for="status-info" class="form-label">Status</label>
                    <div class="form-control"><span id="status-info"></span></div>
                </div>
                <div id="action-info-area" class="d-none">
                    <hr>
                    <div class="mb-3">
                        <label for="action-info-textarea" class="form-label">Tindakan Teknisi</label>
                        <textarea name="action" id="action-info-textarea" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Process Ticket -->
<div class="modal fade" id="problemProcessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="processModalLabel"><span id="ticketnumber-process"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="subject" class="form-label">Mesin</label>
                    <div class="form-control"><span id="subject-process"></span></div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description-process" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status-process" class="form-label">Status</label>
                    <div class="form-control"><span id="status-process"></span></div>
                </div>
                <div id="action-process-area" class="d-none">
                    <hr>
                    <div class="mb-3">
                        <label for="action-process-textarea" class="form-label">Tindakan Teknisi</label>
                        <textarea name="action" id="action-process-textarea" class="form-control" rows="5"></textarea>
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