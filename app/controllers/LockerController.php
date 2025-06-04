<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
