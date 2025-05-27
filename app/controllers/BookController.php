<?php

class BookController extends Controller
{
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
