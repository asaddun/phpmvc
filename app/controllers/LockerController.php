<?php
require_once '../app/core/AuthCheck.php';

class LockerController extends Controller
{
    public function book()
    {
        $data = [
            'judul' => 'Locker',
        ];
        $this->view('components/header', $data);
        $this->view('locker/book');
        $this->view('components/footer');
    }

    public function range($range = 1)
    {
        $limit = 20;
        $start = ($range - 1) * $limit;
        $lockers = $this->model('Locker')->getAllLockers($start, $limit);
        echo json_encode($lockers);
    }

    public function index()
    {
        $data = [
            'judul' => 'Log Locker',
        ];
        $this->view('components/header', $data);
        $this->view('locker/log');
        $this->view('components/footer');
    }

    public function range_log($range = 1)
    {
        $limit = 20;
        $start = ($range - 1) * $limit;
        $log = $this->model('Locker')->getLog($start, $limit);
        echo json_encode($log);
    }

    public function active_log()
    {
        $log = $this->model('Locker')->getLogActive();
        echo json_encode($log);
    }

    public function booking()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $pin = $input['pin'];
        $pinConfirmation = $input['pin_confirmation'];
        $ip = $input['ip'];
        $io = $input['io'];
        $token = '66ae1553a20eb59bb1d4db65f4c4c2d1';

        // Validasi PIN
        // if (empty($pin) || empty($pinConfirmation)) {
        //     echo json_encode(['status' => 'error', 'message' => 'PIN tidak boleh kosong']);
        //     exit;
        // }
        // if ($pin !== $pinConfirmation) {
        //     echo json_encode(['status' => 'error', 'message' => 'PIN tidak sesuai']);
        //     exit;
        // }
        // if (strlen($pin) < 6) {
        //     echo json_encode(['status' => 'error', 'message' => 'PIN minimal 6 digit']);
        //     exit;
        // }

        // Header untuk CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        // Lakukan HTTP request ke locker
        $url = "http://$ip/locker/$io";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['token' => $token]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);
        if ($response && $response['success'] === true) {
            echo json_encode(['status' => 'success', 'message' => 'Loker berhasil dibuka!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Loker tidak merespon.']);
        }
    }
}
