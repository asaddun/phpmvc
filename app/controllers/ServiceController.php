<?php

class ServiceController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Service';
        $this->view('components/header', $data);
        $this->view('service/index', $data);
        $this->view('components/footer');
    }

    public function history()
    {
        $data['judul'] = 'History';
        $this->view('components/header', $data);
        $this->view('service/history', $data);
        $this->view('components/footer');
    }
}
