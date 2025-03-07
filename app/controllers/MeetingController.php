<?php

class MeetingController extends Controller
{
    public function index($date = NULL)
    {
        $data['judul'] = 'Meeting Schedule';
        $data['date'] = $date ?? date("Y-m-d");
        $data['books'] = $this->model('Meeting')->getTodayBooks($data['date']);
        $this->view('components/header', $data);
        $this->view('meeting/index', $data);
        $this->view('components/footer');
    }

    public function booking()
    {
        $date = $_POST['date'];
        $start_time_parts = explode(':', $_POST['start_time']); // Pisahkan jam dan menit
        $start_hour = sprintf('%02d', $start_time_parts[0]); // Format jam agar selalu 2 digit
        $start_minute = $start_time_parts[1]; // Ambil menit
        $start_time = "$start_hour:$start_minute";
        $start_datetime = new DateTime("$date $start_time");
        $start_time_formatted = "$date $start_time:00";
        if (isset($_POST['duration'])) {
            // Tambahkan durasi ke start_time untuk mendapatkan end_time
            $start_datetime->modify("+$_POST[duration] minutes");
            $end_time_formatted = $start_datetime->format("Y-m-d H:i:s");
        } else if (isset($_POST['end_time'])) {
            $end_time_parts = explode(':', $_POST['end_time']); // Pisahkan jam dan menit
            $end_hour = sprintf('%02d', $end_time_parts[0]); // Format jam agar selalu 2 digit
            $end_minute = $end_time_parts[1]; // Ambil menit
            $end_time_formatted = "$date $end_hour:$end_minute:00";
        }

        $maxTime = "21:00";
        $endHour = date("H:i", strtotime($end_time_formatted));
        if ($endHour > $maxTime) {
            Swal::setSwal('Gagal', 'Booking tidak bisa melewati pukul 21:00!', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }

        $today = date("Y-m-d H:i:s");
        // var_dump($start_time_formatted, $end_time_formatted, $today);
        if ($start_time_formatted < $today) {
            Swal::setSwal('Gagal', 'Waktu Mulai sudah berlalu, booking dibatalkan', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }

        if ($this->model('Meeting')->isConflict($_POST['room'], $start_time_formatted, $end_time_formatted)) {
            Swal::setSwal('Gagal', 'Waktu yang dipilih sudah dibooking oleh orang lain!', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }

        if ($this->model('Meeting')->bookingMeet($_POST, $start_time_formatted, $end_time_formatted) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menambahkan data', 'success');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menambahkan data', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }
    }

    public function edit()
    {
        $date = $_POST['date'];
        $start_time_parts = explode(':', $_POST['start_time']); // Pisahkan jam dan menit
        $start_hour = sprintf('%02d', $start_time_parts[0]); // Format jam agar selalu 2 digit
        $start_minute = $start_time_parts[1]; // Ambil menit
        $start_time = "$start_hour:$start_minute";
        $start_datetime = new DateTime("$date $start_time");
        $start_time_formatted = "$date $start_time:00";
        if (isset($_POST['duration'])) {
            // Tambahkan durasi ke start_time untuk mendapatkan end_time
            $start_datetime->modify("+$_POST[duration] minutes");
            $end_time_formatted = $start_datetime->format("Y-m-d H:i:s");
        }

        $maxTime = "21:00";
        $endHour = date("H:i", strtotime($end_time_formatted));
        if ($endHour > $maxTime) {
            Swal::setSwal('Gagal', 'Booking tidak bisa melewati pukul 21:00!', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }

        $today = date("Y-m-d H:i:s");
        // var_dump($start_time_formatted, $end_time_formatted, $today);
        if ($start_time_formatted < $today) {
            Swal::setSwal('Gagal', 'Waktu Mulai sudah berlalu, booking dibatalkan', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }

        if ($this->model('Meeting')->isConflict($_POST['room'], $start_time_formatted, $end_time_formatted)) {
            Swal::setSwal('Gagal', 'Waktu yang dipilih sudah dibooking oleh orang lain!', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }

        if ($this->model('Meeting')->updateBooking($_POST, $start_time_formatted, $end_time_formatted) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil mengupdate data', 'success');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal mengupdate data', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $_POST['date']);
            exit;
        }
    }

    public function delete($id, $date)
    {
        $data = $this->model('Meeting')->deleteBook($id);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menghapus booking', 'success');
            header('Location: ' . BASEURL . '/meeting/' . $date);
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menghapus booking', 'error');
            header('Location: ' . BASEURL . '/meeting/' . $date);
            exit;
        }
    }
}
