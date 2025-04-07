<div class="container d-flex justify-content-center">
    <div class="card" style="width: 24rem;">
        <h4 class="card-header text-center">Service Detail</h4>
        <div class="card-body">
            <h5 class="card-text">Atas nama</h5>
            <p><?= $data['service']['name'] ?></p>
            <h5 class="card-text">Telepon</h5>
            <p><?= $data['service']['phone'] ?></p>
            <h5 class="card-text">Kendaraan</h5>
            <p><?= $data['service']['vehicle'] ?></p>
            <h5 class="card-text">Service yang dipilih</h5>
            <ul>
                <?php foreach ($data['services'] as $service): ?>
                    <li>
                        <div class="row">
                            <div class="col-9">
                                <?= $service['name'] ?>
                                <?php if ($service['qty'] > 1): ?>
                                    x<?= $service['qty'] ?>
                                <?php endif; ?></div>
                            <div class="col">$<?= $service['price'] ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <hr>
            <div class="text-center">
                <h5 class="card-text">Total (Diskon 10%)</h5>
                <p>$<?= $data['service']['total'] ?></p>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= BASEURL ?>/service" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>