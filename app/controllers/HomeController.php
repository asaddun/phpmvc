<?php

class HomeController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home';
        $this->view('components/header', $data);
        $this->view('home/index');
        $this->view('components/footer');
    }

    public function test()
    {
        echo 'home/test';
    }
}
