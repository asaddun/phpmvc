<?php

class NotFoundController extends Controller
{
    public function index()
    {
        http_response_code(404);
        $data = [
            'judul' => 'Error'
        ];
        $this->view('components/header', $data);
        $this->view('errors/404');
        $this->view('components/footer');
    }
}
