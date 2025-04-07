<div class="container">
    <div class="d-flex align-items-center justify-content-between py-3">
        <h3>Daftar Harga</h3>
        <?php if ($data['user']['level'] == 2): ?>
            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#bsModal"
                data-action="add">
                <i class="fa-solid fa-plus"></i>
                Tambah
            </button>
        <?php endif; ?>
    </div>

    <table class="table table-bordered text-center bg-white">
        <thead class="text-white">
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <?php if ($data['user']['level'] == 2): ?>
                    <th scope="col">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $i = 1; ?>
            <?php if ($data['services']): ?>
                <?php foreach ($data['services'] as $service): ?>
                    <tr>
                        <td scope="row"><?= $i ?></td>
                        <td><?= $service['name'] ?></td>
                        <td>$<?= number_format($service['price']) ?></td>
                        <?php if ($data['user']['level'] == 2): ?>
                            <td>
                                <!-- <button class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button> -->
                                <button class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#bsModal"
                                    data-action="edit"
                                    data-id="<?= $service['id'] ?>"
                                    data-service="<?= $service['name'] ?>"
                                    data-category="<?= $service['category'] ?>"
                                    data-level="<?= $service['level'] ?>"
                                    data-price="<?= $service['price'] ?>">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger" onclick="showConfirmationDelete('<?= $service['id'] ?>')"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php $i += 1; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
    </table>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="bsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><span id="bsModalTitle"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="bsModalForm" method="POST" action="<?= BASEURL ?>/service/edit-price">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="id-modal" name="id">
                        <label for="service-modal" class="form-label">Name</label>
                        <input type="text" class="form-control" id="service-modal" name="service">
                    </div>
                    <div class="mb-3">
                        <label for="category-modal" class="form-label">Kategori</label>
                        <!-- <input type="text" class="form-control" id="category-modal" name="category"> -->
                        <select name="category" id="category-modal" class="form-select">
                            <?php foreach ($data['categories'] as $category): ?>
                                <option value="<?= $category['value'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level-modal" class="form-label">Level</label>
                        <!-- <input type="number" class="form-control" id="level-modal" name="level"> -->
                        <select name="level" id="level-modal" class="form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price-modal" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price-modal" name="price">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><span id="bsModalSubmitButton"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const bsModal = document.getElementById("bsModal");
    if (bsModal) {
        bsModal.addEventListener("show.bs.modal", function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const action = button.getAttribute("data-action");
            if (action == "edit") {
                const id = button.getAttribute("data-id");
                const service = button.getAttribute("data-service");
                const category = button.getAttribute("data-category");
                const level = button.getAttribute("data-level");
                const price = button.getAttribute("data-price");

                document.getElementById("bsModalTitle").textContent = "Edit Service";
                document.getElementById("id-modal").value = id;
                document.getElementById("service-modal").value = service;
                document.getElementById("category-modal").value = category;
                document.getElementById("level-modal").value = level;
                document.getElementById("level-modal").disabled = false;
                document.getElementById("price-modal").value = price;
                document.getElementById("bsModalSubmitButton").textContent = "Update";
                document.getElementById("bsModalForm").action = BASEURL + "/service/edit-price";
            } else if (action == "add") {
                document.getElementById("bsModalTitle").textContent = "Tambah Service";
                document.getElementById("id-modal").value = null;
                document.getElementById("service-modal").value = "";
                document.getElementById("category-modal").value = "";
                document.getElementById("level-modal").value = "";
                document.getElementById("level-modal").disabled = true;
                document.getElementById("price-modal").value = "";
                document.getElementById("bsModalSubmitButton").textContent = "Buat";
                document.getElementById("bsModalForm").action = BASEURL + "/service/add-price";
            }
        });
    }

    function showConfirmationDelete(data) {
        const id = data;
        Swal.fire({
            title: "Hapus Service?",
            text: "Apakah Anda yakin ingin menghapus service ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = BASEURL + "/service/delete-price/" + id;
            }
        });
    }
</script>