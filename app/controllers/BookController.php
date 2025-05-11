<?php

class BookController extends Controller
{
    public function index()
    {
        $books = $this->model('Book')->getAllBooks();
        $data = [
            'judul' => 'Book',
            'books' => $books,
        ];
        $this->view('components/header', $data);
        $this->view('book/index', $data);
        $this->view('components/footer');
    }
}
