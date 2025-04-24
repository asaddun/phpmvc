<?php

class QueueController extends Controller
{
    private $counter = [
        ['name' => 'Counter 1', 'value' => 1],
        ['name' => 'Counter 2', 'value' => 2],
        ['name' => 'Counter 3', 'value' => 3],
        ['name' => 'Counter 4', 'value' => 4],
    ];

    public function index()
    {
        $data = [
            'judul' => 'Antrian',
            'counter' => $this->counter,

        ];
        $this->view('components/header', $data);
        $this->view('queue/index', $data);
        $this->view('components/footer');
    }

    public function register()
    {
        $data['judul'] = 'Daftar Antrian';
        $this->view('components/header', $data);
        $this->view('queue/register');
        $this->view('components/footer');
    }

    public function counter()
    {
        $data = [
            'judul' => 'Panggilan Antrian',
            'counter' => $this->counter,

        ];
        $this->view('components/header', $data);
        $this->view('queue/counter', $data);
        $this->view('components/footer');
    }

    public function get_counter_data()
    {
        $today = date('Y-m-d');
        $counterData = $this->model('Queue')->getCounterData($today);
        echo json_encode($counterData);
    }

    public function get_queue()
    {
        $activeTypes = $this->model('Queue')->getActiveType();
        echo json_encode($activeTypes);
    }

    public function get_waiting_queue()
    {
        // Inisialisasi awal dengan key kosong
        $queues = [
            'A' => [],
            'B' => [],
            'C' => []
        ];

        // Ambil dari database yang status = 1
        $rawQueues = $this->model('Queue')->getWaitingQueues();

        foreach ($rawQueues as $item) {
            $type = $item['type'];
            $queues[$type][] = $item['code'];
        }

        echo json_encode($queues);
    }

    public function call($type)
    {
        $queue = $this->model('Queue')->getActiveQueueByType($type);
        $data = [
            'id' => $queue['id'],
            'counter' => $_POST['counter'],
        ];
        if ($queue) {
            $this->model('Queue')->updateQueueStatusCalling($data);
            echo json_encode([
                'status' => 'success',
                'code' => $queue['code'],
                'id' => $queue['id'],
            ]);
        } else {
            echo json_encode([
                'status' => 'empty',
                'code' => 'Empty',
            ]);
        }
    }

    public function call_again($id)
    {
        $data = [
            'id' => $id,
            'counter' => $_POST['counter'],
        ];
        if ($this->model('Queue')->updateQueueStatusCalling($data) > 0) {
            echo json_encode([
                'status' => 'success',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
            ]);
        }
    }

    public function process($id)
    {
        $data = [
            'id' => $id,
            'counter' => $_POST['counter'],
        ];
        $this->model('Queue')->updateQueueStatusProcess($data);
    }

    public function done($id)
    {
        $data = [
            'id' => $id,
        ];
        $this->model('Queue')->updateQueueStatusDone($data);
    }

    public function add()
    {
        $today = date('Y-m-d');
        $type = $_POST['choice'];
        if (empty($type)) {
            Swal::setSwal('Gagal', 'Gagal mendaftar antrian, harap pilih jenis antrian', 'error');
            header('Location: ' . BASEURL . '/queue/register/');
            exit;
        }
        $maxNumber = $this->model('Queue')->getMaxNumberByType($type, $today);
        $newNumber = $maxNumber + 1;
        $code = $type . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        $data = [
            'code' => $code,
            'type' => $type,
            'number' => $newNumber,
        ];
        if ($this->model('Queue')->addQueue($data) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil mendaftar antrian', 'success', 2000);
            header('Location: ' . BASEURL . '/queue/register/');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal mendaftar antrian', 'error', 2000);
            header('Location: ' . BASEURL . '/queue/register/');
            exit;
        }
    }
}
