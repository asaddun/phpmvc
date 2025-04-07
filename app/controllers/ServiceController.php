<?php

class ServiceController extends Controller
{
    public function index($page = 1)
    {
        $limit = 10;
        $start = ($page > 1) ? ($page * $limit) - $limit : 0;
        $totalData = $this->model('Service')->countAllServiceLog();
        $totalPages = ceil($totalData / $limit);
        // limit tampil history
        $data = [
            'judul' => 'Service',
            'services' => $this->model('Service')->getAllServicesLog($start, $limit),
            'page' => $page,
            'totalPages' => $totalPages,
        ];
        // var_dump($data['services']);
        $this->view('components/header', $data);
        $this->view('service/index', $data);
        $this->view('components/footer');
    }

    public function order()
    {
        $services = $this->model('Service')->getAllPrices();
        $engine = array_filter($services, fn($service) => $service['category'] == 1);
        $transmission = array_filter($services, fn($service) => $service['category'] == 2);
        $suspension = array_filter($services, fn($service) => $service['category'] == 3);
        $brakes = array_filter($services, fn($service) => $service['category'] == 4);
        $turbo = array_filter($services, fn($service) => $service['category'] == 5);
        $trunk = array_filter($services, fn($service) => $service['category'] == 6);
        $bodywork = array_filter($services, fn($service) => $service['category'] == 7);
        $tint = array_filter($services, fn($service) => $service['category'] == 8);
        $tire = array_filter($services, fn($service) => $service['category'] == 9);
        $horn = array_filter($services, fn($service) => $service['category'] == 10);
        $color = array_filter($services, fn($service) => $service['category'] == 11);
        $light = array_filter($services, fn($service) => $service['category'] == 12);
        $neon = array_filter($services, fn($service) => $service['category'] == 13);
        $misc = array_filter($services, fn($service) => $service['category'] == 14);
        $data = [
            'judul' => 'Create',
            'engine' => $engine,
            'transmission' => $transmission,
            'suspension' => $suspension,
            'brakes' => $brakes,
            'turbo' => $turbo,
            'trunk' => $trunk,
            'bodywork' => $bodywork,
            'tint' => $tint,
            'tire' => $tire,
            'horn' => $horn,
            'color' => $color,
            'light' => $light,
            'neon' => $neon,
            'misc' => $misc,
        ];
        $this->view('components/header', $data);
        $this->view('service/order', $data);
        $this->view('components/footer');
    }

    public function detail($id)
    {
        $service_log = $this->model('Service')->getServicesLogById($id);
        $service_array = explode(',', $service_log['services']);
        $service_prices = [];
        foreach ($this->model('Service')->getAllPrices() as $service) {
            $service_prices[$service['id']] = $service;
        }
        $serviceCounts = array_count_values($service_array);
        $selectedServices = [];
        foreach ($serviceCounts as $id => $qty) {
            if (isset($service_prices[$id])) {
                $selectedServices[] = [
                    'name' => $service_prices[$id]['name'],
                    'price' => $service_prices[$id]['price'],
                    'qty' => $qty
                ];
            } else {
                // Service sudah dihapus, tetap tambahkan sebagai placeholder
                $selectedServices[] = [
                    'name' => '<span class="text-danger">Service tidak ditemukan<br>(sudah dihapus)</span>',
                    'price' => '-',
                    'qty' => $qty
                ];
            }
        }
        // var_dump($service, $service_array);
        $data = [
            'judul' => 'Detail',
            'service' => $service_log,
            'services' => $selectedServices,
        ];
        $this->view('components/header', $data);
        $this->view('service/detail', $data);
        $this->view('components/footer');
    }

    public function confirm()
    {
        if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['vehicle'])) {
            Swal::setSwal('Error', 'Mohon isi data diri dengan benar', 'error');
            header('Location: ' . BASEURL . '/service/order');
            exit;
        }

        $services = $_POST['services'];
        $filteredServices = array_filter($services, function ($value) {
            return $value != 0;
        });

        $bodyworks = 0;
        if ($_POST['bodyworks'] > 0) {
            $bodyworks = $_POST['bodyworks'];
        }

        if (empty($filteredServices) && $bodyworks == 0) {
            Swal::setSwal('Error', 'Mohon pilih jasa service', 'error');
            header('Location: ' . BASEURL . '/service/order');
            exit;
        }

        for ($i = 0; $i < $bodyworks; $i++) {
            $filteredServices[] = 23;
        }

        $serviceCounts = array_count_values($filteredServices);

        $service_prices = [];
        foreach ($this->model('Service')->getAllPrices() as $service) {
            $service_prices[$service['id']] = $service;
        }
        $selectedServices = [];
        $subtotal = 0;
        foreach ($serviceCounts as $id => $qty) {
            if (isset($service_prices[$id])) {
                $selectedServices[] = [
                    'name' => $service_prices[$id]['name'],
                    'price' => $service_prices[$id]['price'],
                    'qty' => $qty
                ];
                $subtotal += $service_prices[$id]['price'] * $qty;
            }
        }
        $tenPercent = $subtotal * 0.1;
        $total = $subtotal - $tenPercent;

        $data = [
            'judul' => 'Service Confirmation',
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'vehicle' => $_POST['vehicle'],
            'service' => $selectedServices,
            'serviceArray' => $filteredServices,
            'subtotal' => $subtotal,
            'total' => $total,
        ];
        $this->view('components/header', $data);
        $this->view('service/confirmation', $data);
        $this->view('components/footer');
    }

    public function book()
    {
        $services = implode(',', $_POST['services']);
        if ($this->model('Service')->addBooking($_POST, $services) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil memasang pesanan', 'success');
            header('Location: ' . BASEURL . '/service/');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal memasang pesanan', 'error');
            header('Location: ' . BASEURL . '/service/');
            exit;
        }
    }

    public function price_list()
    {
        $services = $this->model('Service')->getAllPrices();
        $categories = $this->model('Service')->getAllCategory();
        $user = $this->model('User')->getUserByUsername($_SESSION['username']);
        $data = [
            'judul' => 'Price List',
            'services' => $services,
            'categories' => $categories,
            'user' => $user,
        ];
        $this->view('components/header', $data);
        $this->view('service/price-list', $data);
        $this->view('components/footer');
    }

    public function add_price()
    {
        $maxLevel = $this->model('Service')->getMaxLevelByCategory($_POST['category']);
        $new_level = ($maxLevel !== null) ? $maxLevel + 1 : 1;
        if ($this->model('Service')->addPrice($_POST, $new_level) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menambahkan Service', 'success');
            header('Location: ' . BASEURL . '/service/price-list/');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menambahkan Service', 'error');
            header('Location: ' . BASEURL . '/service/price-list/');
            exit;
        }
    }
    public function edit_price()
    {
        $id = $_POST['id'];
        $category = $_POST['category'];
        $new_level = $_POST['level'];

        $service = $this->model('Service')->getPriceById($id);

        // Jika kategori diubah, sesuaikan level baru dengan kategori itu
        if ($category != $service['category']) {
            $new_level = $this->model('Service')->getMaxLevelByCategory($category) + 1;
        }

        // Cek apakah level berubah
        if ($new_level != $service['level']) {
            // Cari item yang memiliki level yang akan diganti
            $conflicted_service = $this->model('Service')->getPriceByLevel($category, $new_level);

            if ($conflicted_service) {
                // Tukar level service yang ada dengan yang baru
                $this->model('Service')->updatePriceLevel($conflicted_service['id'], $service['level']);
            }
        }

        if ($this->model('Service')->editPrice($_POST, $new_level) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil mengubah Service', 'success');
            header('Location: ' . BASEURL . '/service/price-list/');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal mengubah Service', 'error');
            header('Location: ' . BASEURL . '/service/price-list/');
            exit;
        }
    }

    public function delete_price($id)
    {
        if ($this->model('Service')->deletePrice($id) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menghapus Service', 'success');
            header('Location: ' . BASEURL . '/service/price-list/');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menghapus Service', 'error');
            header('Location: ' . BASEURL . '/service/price-list/');
            exit;
        }
    }
}
