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
    <button class="btn btn-primary position-relative">
        <i class="fa-solid fa-cart-shopping"></i> View Cart
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <span id="cart-badge"></span>
            <span class="visually-hidden">cart</span>
        </span>
        </span>
    </button>
</div>
<div class="row row-cols-1 row-cols-lg-4 g-3 px-5">
    <?php foreach ($data['books'] as $book): ?>
        <div class="col">
            <div class="card" style="width: 14rem; height:14rem;">
                <div class="card-body d-flex flex-column">
                    <div class="card-title fw-bold"><?= $book['title'] ?></div>
                    <p class="card-text"><?= $book['description'] ?></p>
                    <div class="mt-auto d-flex justify-content-between">
                        <a class="btn btn-primary" href="<?= BASEURL . '/book/detail/' . $book['isbn'] ?>">Detail</a>
                        <button
                            class="btn btn-success add-to-cart"
                            data-id=<?= $book['book_id'] ?>
                            data-user=<?= $data['user']['id'] ?>>
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function checkCart() {
        fetch(`${BASEURL}/book/get-cart-total`)
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('cart-badge');
                badge.textContent = data;
            });

    }

    checkCart();

    setInterval(() => {
        checkCart();
    }, 2000);

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const bookId = button.getAttribute('data-id');
            const userId = button.getAttribute('data-user');
            const data = new URLSearchParams();
            data.append('book_id', bookId);
            data.append('user_id', userId);

            fetch(`${BASEURL}/book/add-to-cart`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update badge keranjang
                        console.log(data.message);
                        Swal.fire({
                            title: data.message,
                            // text: data.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        // alert(data.message || 'Gagal menambahkan ke keranjang.');
                        Swal.fire({
                            title: data.message || 'Gagal menambahkan ke keranjang.',
                            // text: data.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
        });
    });
</script>