<?php

class AndonController extends Controller
{
    public function index()
    {
        $file = __DIR__ . '/../../storage/json/mesin.json';
        $json = json_decode(file_get_contents($file), true);

        $data = [
            'judul' => 'Reset Andon',
            'mesin' => $json,
        ];

        $this->view('components/header', $data);
        $this->view('andon/index', $data);
        $this->view('components/footer');
    }

    public function reset()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';
        $id = $input['id'] ?? '';
        $button = $input['button'] ?? '';

        if (empty($action) || empty($id)) {
            // echo json_encode(['status' => 'error', 'message' => 'Form tidak lengkap']);
            echo json_encode(['status' => 'error', 'message' => [$action, $id, $button]]);
            exit;
        }

        // Dapatkan waktu saat ini dalam format UNIX timestamp
        $time = time();

        $ip = '192.168.1.41';

        // Buat array JSON
        $data = [
            "action" => $action,
            "id" => (int) $id,
            "button" => (int) $button,
            "time" => $time,
            "ip" => $ip
        ];

        // Encode ke JSON
        echo json_encode(['status' => 'success', 'message' => $data]);
    }

    public function update()
    {
        $key = "N3v3rg1v3up!";
        $url = 'https://apik.adyawinsa.com/smsd/api/all_assets.php?key=' . $key;

        // Stream context to disable SSL verification
        $options = [
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ];
        $context = stream_context_create($options);

        // Use file_get_contents with the context
        $response = file_get_contents($url, false, $context);

        // Check if the request was successful
        if ($response === FALSE) {
            die('Error occurred while fetching data.');
        }

        // Decode the JSON response (if the API returns JSON)
        $data = json_decode($response, true);

        $file = __DIR__ . '/../../storage/json/mesin.json';

        $keysToStore = ['A_ASSET_ID', 'VALUE']; // Only store 'id' and 'name'

        // Filter the data to include only the specified keys
        $filteredData = array_map(function ($item) use ($keysToStore) {
            return array_intersect_key($item, array_flip($keysToStore));
        }, $data);

        // Encode the filtered data back to JSON format (for pretty printing)
        $json = json_encode($filteredData);

        // Write the JSON data to the file (this will create or overwrite the file)
        if (file_put_contents($file, $json) !== false) {
            echo json_encode(['status' => 'success', 'message' => "Berhasil update"]);
        } else {
            echo json_encode(['status' => 'error', 'message' => "Gagal update"]);
        }
    }
}
