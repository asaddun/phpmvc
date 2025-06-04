<?php

class LockerController extends Controller
{
    public function index()
    {
        $lockers = $this->model('Locker')->getAllLockers();
        $data = [
            'judul' => 'Locker',
            'lockers' => $lockers,
        ];
        var_dump($data['lockers']);
        // $this->view('components/header', $data);
        // $this->view('locker/index', $data);
        // $this->view('components/footer');
    }
}
