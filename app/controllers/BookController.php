<?php

class BookController extends Controller
{

    // Fetch data buku dari Open Library API
    public function import()
    {
        $url = "https://openlibrary.org/search.json?q=fiction&limit=50";
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        if (empty($data['docs'])) {
            echo "Data tidak ditemukan.";
            return;
        }

        $countInserted = 0;
        foreach ($data['docs'] as $book) {
            $data = [
                'title' => $book['title'] ?? '',
                'authors' => rand(1, 3),
                'isbn' => isset($book['isbn'][0]) ? $book['isbn'][0] : '',
                'category' => rand(1, 3),
                'year' => $book['first_publish_year'] ?? null,
                'publisher' => isset($book['publisher'][0]) ? $book['publisher'][0] : '',
                'stock' => rand(1, 30),
                'cover' => isset($book['cover_i']) ? "https://covers.openlibrary.org/b/id/{$book['cover_i']}-M.jpg" : '',
            ];

            if (!$data['isbn']) {
                // Lewati jika tidak ada ISBN
                continue;
            }

            // Insert data buku
            $this->model('Book')->pushBooks($data);
            $countInserted++;
        }

        echo "$countInserted data buku berhasil disimpan ke database.";
    }

    public function index()
    {
        $books = $this->model('Book')->getAllBooks();
        $user = $this->model('User')->getUserByUsername($_SESSION['username']);
        $data = [
            'judul' => 'Book',
            'books' => $books,
            'user' => $user,
        ];
        $this->view('components/header', $data);
        $this->view('book/index', $data);
        $this->view('components/footer');
    }

    public function detail($isbn)
    {
        $book = $this->model('Book')->getBookByISBN($isbn);
        if (!$book) {
            Swal::setSwal('Error', 'Buku tidak ditemukan', 'error');
            header('Location: ' . BASEURL . '/book');
            exit;
        }
        var_dump($book);
    }

    public function get_cart_total()
    {
        $user = $this->model('User')->getUserByUsername($_SESSION['username']);
        $cart = $this->model('Book')->getCartTotal($user['id']);
        echo json_encode($cart);
    }

    public function add_to_cart()
    {
        $bookId = $_POST['book_id'] ?? null;
        $userId = $_POST['user_id'] ?? null;
        if (!isset($bookId) || !isset($userId)) {
            echo json_encode(['success' => false, 'message' => 'Book or User is missing']);
            return;
        }
        if ($this->model('Book')->checkCart($bookId, $userId) > 0) {
            $this->model('Book')->updateQuantity($bookId, $userId);
            echo json_encode(['success' => true, 'message' => 'Berhasil menambahkan buku']);
        } else {
            $this->model('Book')->addToCart($bookId, $userId);
            echo json_encode(['success' => true, 'message' => 'Berhasil menambahkan buku']);
        }
    }
}
