<div class="container d-flex justify-content-center">
    <div class="card" style="width: 24rem;">
        <h4 class="card-header text-center">Service Konfirmasi</h4>
        <div class="card-body">
            <h5 class="card-text">Atas nama</h5>
            <p><?= $data['name'] ?></p>
            <h5 class="card-text">Telepon</h5>
            <p><?= $data['phone'] ?></p>
            <h5 class="card-text">Kendaraan</h5>
            <p><?= $data['vehicle'] ?></p>
            <h5 class="card-text">Service yang dipilih</h5>
            <ul>
                <?php foreach ($data['service'] as $service): ?>
                    <li>
                        <div class="row">
                            <div class="col-9"><?= $service['name'] ?>
                                <?php if ($service['qty'] > 1): ?>
                                    x<?= $service['qty'] ?>
                                <?php endif; ?></div>
                            <div class="col">$<?= $service['price'] ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <hr>
            <div class="d-flex justify-content-between text-center w-75 mx-auto">
                <div>
                    <h5 class="card-text">Subtotal</h5>
                    <p>$<?= $data['subtotal'] ?></p>
                </div>
                <div>
                    <h5 class="card-text">Total (Diskon 10%)</h5>
                    <p class="fw-bold">$<?= $data['total'] ?></p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= BASEURL ?>/service/order" class="btn btn-danger">Kembali</a>
                <form action="<?= BASEURL ?>/service/book" method="POST">
                    <input type="hidden" name="name" value="<?= $data['name'] ?>">
                    <input type="hidden" name="phone" value="<?= $data['phone'] ?>">
                    <input type="hidden" name="vehicle" value="<?= $data['vehicle'] ?>">
                    <?php foreach ($data['serviceArray'] as $value): ?>
                        <input type="hidden" name="services[]" value="<?= htmlspecialchars($value) ?>">
                    <?php endforeach; ?>
                    <input type="hidden" name="total" value="<?= $data['total'] ?>">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>