<?php

class AboutController extends Controller
{
    public function index()
    {
        $data['nama'] = 'Ultraman';
        $data['judul'] = 'About';
        // $this->view('components/header', $data);
        $this->view('about/index', $data);
        // $this->view('components/footer');
    }
}
