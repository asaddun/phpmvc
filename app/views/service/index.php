<div class="container">
    <div class="d-flex align-items-center justify-content-between py-3">
        <h3>Riyawat Service</h3>
        <a href="<?= BASEURL ?>/service/order" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Order</a>
    </div>
    <table class="table table-hover text-center bg-white">
        <thead class="text-white" style="background-color: #383434">
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama</th>
                <th scope="col">Kendaraan</th>
                <th scope="col">Total</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['services']): ?>
                <?php foreach ($data['services'] as $service): ?>
                    <tr>
                        <td scope="row" class="d-none d-md-table-cell"><?= $service['created_at'] ?></td>
                        <td><?= $service['name'] ?></td>
                        <td><?= $service['vehicle'] ?></td>
                        <td>$<?= $service['total'] ?></td>
                        <td><a href="<?= BASEURL ?>/service/detail/<?= $service['id'] ?>" class="btn btn-primary"><i class="fa-solid fa-info"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Data tidak ditemukan</td>
                </tr>
            <?php endif; ?>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= ($data['page'] == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= BASEURL ?>/service/<?= $data['page'] - 1 ?>">&laquo;</a>
            </li>

            <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= BASEURL ?>/service/<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($data['page'] == $data['totalPages']) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= BASEURL ?>/service/<?= $data['page'] + 1 ?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>