<?php

class MapController extends Controller
{
    public function index()
    {
        $data['judul'] = 'The Peninsula';
        $this->view('components/header', $data);
        $this->view('map/index', $data);
        $this->view('components/footer');
    }
}
