<style>
    .card-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        /* Menampilkan maksimal 3 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        /* Menampilkan maksimal 3 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="d-flex justify-content-between px-5 mb-4">
    <h3>Toko Buku</h3>
    <button class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> View Cart</button>
</div>
<div class="row row-cols-1 row-cols-lg-4 g-3 px-5">
    <?php foreach ($data['books'] as $book): ?>
        <div class="col">
            <div class="card" style="width: 14rem; height:14rem;">
                <div class="card-body d-flex flex-column">
                    <div class="card-title fw-bold"><?= $book['title'] ?></div>
                    <p class="card-text"><?= $book['description'] ?></p>
                    <div class="mt-auto d-flex justify-content-between">
                        <a class="btn btn-primary">Detail</a>
                        <button class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>