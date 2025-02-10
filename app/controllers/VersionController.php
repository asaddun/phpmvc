<?php

class VersionController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Version';
        $data['mesin'] = $this->model('Problem')->getAllMesin();
        $this->view('components/header', $data);
        $this->view('version/index', $data);
        $this->view('components/footer');
    }
}
