<?php

class ProblemController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Problem';
        $user = $this->model('User')->getUserByUsername($_SESSION['username']);
        $data['user'] = $user;
        $this->view('components/header', $data);
        $this->view('problem/index', $data);
        $this->view('components/footer');
    }

    // public function queue()
    // {
    //     $data['judul'] = 'Ticket Queue';
    //     $user = $this->model('User')->getUserByUsername($_SESSION['username']);
    //     $data['user'] = $user;
    //     $data['ticket'] = $this->model('Ticket')->getAllQueueTicket();
    //     $this->view('components/header', $data);
    //     $this->view('ticket/ticket_status');
    //     $this->view('ticket/queue', $data);
    //     $this->view('components/footer');
    // }

    // public function history()
    // {
    //     $data['judul'] = 'Ticket History';
    //     $data['ticket'] = $this->model('Ticket')->getAllHistoryTicket();
    //     $this->view('components/header', $data);
    //     $this->view('ticket/ticket_status');
    //     $this->view('ticket/history', $data);
    //     $this->view('components/footer');
    // }

    public function tambah()
    {
        if ($this->model('Problem')->addProblem($_POST) > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menambahkan data', 'success');
            header('Location: ' . BASEURL . '/problem');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menambahkan data', 'error');
            header('Location: ' . BASEURL . '/problem');
            exit;
        }
    }

    public function send($ticketNumber)
    {
        $data = $this->model('Ticket')->sendTicket($ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil mengirimkan tiket', 'success');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal mengirimkan tiket', 'error');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        }
    }

    public function cancel($ticketNumber)
    {
        $data = $this->model('Ticket')->cancelTicket($ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil membatalkan tiket', 'success');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal membatalkan tiket', 'error');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        }
    }

    public function update($ticketNumber)
    {
        $data = $this->model('Ticket')->updateTicket($_POST, $ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil mengubah tiket', 'success');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal mengubah tiket', 'error');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        }
    }

    public function process($ticketNumber)
    {
        $data = $this->model('Ticket')->processTicket($ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil memproses tiket', 'success');
            header('Location: ' . BASEURL . '/ticket/queue');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal memproses tiket', 'error');
            header('Location: ' . BASEURL . '/ticket/queue');
            exit;
        }
    }

    public function hold($ticketNumber)
    {
        $data = $this->model('Ticket')->holdTicket($_POST, $ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menunda tiket', 'success');
            header('Location: ' . BASEURL . '/ticket/queue');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal memproses tiket', 'error');
            header('Location: ' . BASEURL . '/ticket/queue');
            exit;
        }
    }

    public function close($ticketNumber)
    {
        $data = $this->model('Ticket')->closeTicket($_POST, $ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menutup tiket', 'success');
            header('Location: ' . BASEURL . '/ticket/queue');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menutup tiket', 'error');
            header('Location: ' . BASEURL . '/ticket/queue');
            exit;
        }
    }

    public function delete($ticketNumber)
    {
        $data = $this->model('Ticket')->deleteTicket($ticketNumber);
        if ($data > 0) {
            Swal::setSwal('Berhasil', 'Berhasil menghapus tiket', 'success');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal menghapus tiket', 'error');
            header('Location: ' . BASEURL . '/ticket');
            exit;
        }
    }
}
