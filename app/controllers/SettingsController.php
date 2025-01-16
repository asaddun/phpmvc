<?php

class SettingsController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = $this->model('User')->getUserByUsername($_SESSION['username']);
    }

    public function index()
    {
        $data['judul'] = 'Settings';
        $data['email'] = $this->user['email'];
        $this->view('components/header', $data);
        $this->view('settings/index', $data);
        $this->view('components/footer');
    }

    public function email()
    {
        $data['judul'] = 'Settings';
        $data['email'] = $this->user['email'];
        $this->view('components/header', $data);
        $this->view('settings/email', $data);
        $this->view('components/footer');
    }

    public function changeemail()
    {
        if ($this->model('User')->checkExistEmailUser($_POST['email']) > 0) {
            Swal::setSwal('Gagal', 'Email sudah terdaftar', 'error');
            header('Location: ' . BASEURL . '/settings/email');
            exit;
        } else {
            if ($this->model('User')->updateEmailUser($this->user['username'], $_POST['email']) > 0) {
                Swal::setSwal('Berhasil', 'Email berhasil diubah', 'success');
                header('Location: ' . BASEURL . '/settings');
                exit;
            } else {
                Swal::setSwal('Gagal', 'Email gagal diubah', 'error');
                header('Location: ' . BASEURL . '/settings');
                exit;
            }
        }
    }

    public function password()
    {
        $data['judul'] = 'Settings';
        $this->view('components/header', $data);
        $this->view('settings/password', $data);
        $this->view('components/footer');
    }

    public function changepassword()
    {
        if (strlen($_POST['password']) < 8 || !preg_match('/\d/', $_POST['password'])) {
            Swal::setSwal('Gagal', 'Password harus minimal 8 karakter dan minial satu angka', 'error');
            header('Location: ' . BASEURL . '/settings/password');
            exit;
        }

        // Check if password and confirm password match
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            Swal::setSwal('Gagal', 'Password tidak sesuai', 'error');
            header('Location: ' . BASEURL . '/settings/password');
            exit;
        }

        if ($this->model('User')->updatePasswordUser($this->user['username'], $_POST['password']) > 0) {
            Swal::setSwal('Berhasil', 'Password berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/settings');
            exit;
        } else {
            Swal::setSwal('Gagal', 'Password gagal diubah', 'error');
            header('Location: ' . BASEURL . '/settings');
            exit;
        }
    }
}
