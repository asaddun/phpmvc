<?php

class AuthController extends Controller
{
    public function index($redirect = NULL)
    {
        $data['redirect'] = $redirect;
        $data['judul'] = 'Login';
        $this->view('components/header', $data);
        $this->view('auth/index', $data);
        $this->view('components/footer');
    }

    public function signup()
    {
        $data['judul'] = 'Daftar';
        $this->view('components/header', $data);
        $this->view('auth/signup', $data);
        $this->view('components/footer');
    }

    public function register()
    {
        $_SESSION['formData'] = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
        ];

        if ($this->model('User')->checkExistUser($_POST['username'], $_POST['email'])) {
            Swal::setSwal('Gagal', 'Username atau Email sudah terdaftar', 'error');
            header('Location: ' . BASEURL . '/auth/signup');
            exit;
        }

        if (strlen($_POST['password']) < 8 || !preg_match('/\d/', $_POST['password'])) {
            Swal::setSwal('Gagal', 'Password harus minimal 8 karakter dan minial satu angka', 'error');
            header('Location: ' . BASEURL . '/auth/signup');
            exit;
        }

        // Check if password and confirm password match
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            Swal::setSwal('Gagal', 'Password tidak sesuai', 'error');
            header('Location: ' . BASEURL . '/auth/signup');
            exit;
        }

        unset($_SESSION['formData']);
        if ($this->model('User')->addUser($_POST) > 0) {
            $_SESSION['username'] = $_POST['username'];
            Swal::setSwal('Berhasil', 'Daftar akun berhasil', 'success');
            header('Location: ' . BASEURL);
            exit;
        } else {
            Swal::setSwal('Gagal', 'Gagal mendaftarkan akun', 'error');
            header('Location: ' . BASEURL . '/auth/signup');
            exit;
        }
    }

    public function signin($redirect = NULL)
    {
        $_SESSION['formData'] = [
            'username' => $_POST['username']
        ];
        $user = $this->model('User')->getUserByUsername($_POST['username']);
        if (!$user) {
            Swal::setSwal('Gagal', 'Akun tidak terdaftar', 'error');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['username'] = $_POST['username'];
            Swal::setSwal('Berhasil', 'Login berhasil', 'success');
            unset($_SESSION['formData']);
            if ($redirect) {
                header('Location: ' . BASEURL . "/$redirect");
            } else {
                header('Location: ' . BASEURL);
            }
        } else {
            Swal::setSwal('Gagal', 'Username atau Password tidak sesuai', 'error');
            if ($redirect) {
                header('Location: ' . BASEURL . '/auth' . "/$redirect");
            } else {
                header('Location: ' . BASEURL . '/auth');
            }
            exit;
        }
    }

    public function forgotpassword()
    {
        $data['judul'] = 'Lupa Password';
        $this->view('components/header', $data);
        $this->view('auth/forgotpassword', $data);
        $this->view('components/footer');
    }

    public function forgotpasswordsent()
    {
        $user = $this->model('User')->getUserByEmail($_POST['email']);
        if (!$user) {
            Swal::setSwal('Gagal', 'Akun tidak terdaftar', 'error');
            header('Location: ' . BASEURL . '/auth/forgotpassword');
            exit;
        } else if ($user) {
            $token = $this->model('User')->createTokenReset($user['username']);
            // Swal::setSwal('Berhasil', 'Login berhasil', 'success');
            $tokenlink = BASEURL . '/auth/resetpassword/' . $user['username'] . '/' . $token;
            $loginurl = BASEURL . '/auth';

            $recipientEmail = $user['email'];
            $subject = 'Reset Password';
            $body = '
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Reset Password</title>
                <style>
                    /* Define the custom container class */
                    .container {
                        width: 100%;
                        max-width: 720px;
                        /* Adjust this based on your design */
                        margin: 0 auto;
                        /* Center the container */
                        padding-left: 15px;
                        padding-right: 15px;
                    }

                    /* Responsive behavior */
                    @media (max-width: 1200px) {
                        .container {
                            max-width: 960px;
                        }
                    }

                    @media (max-width: 992px) {
                        .container {
                            max-width: 720px;
                        }
                    }

                    @media (max-width: 768px) {
                        .container {
                            max-width: 540px;
                        }
                    }
                    
                    p {
                        font-size: 18px;
                    }

                    .btn {
                        display: inline-block;
                        padding: 10px 20px;
                        /* Adjust padding for size */
                        font-size: 16px;
                        /* Adjust font size */
                        font-weight: 600;
                        /* Bold text */
                        color: #ffffff;
                        /* Text color */
                        background-color: #007bff;
                        /* Default background color (Bootstrap blue) */
                        border: 1px solid #007bff;
                        /* Border to match background */
                        border-radius: 5px;
                        /* Rounded corners */
                        text-align: center;
                        /* Center the text */
                        text-decoration: none;
                        /* Remove underline for links */
                        cursor: pointer;
                        /* Pointer cursor on hover */
                        transition: all 0.3s ease;
                        /* Smooth transition for hover effects */
                    }

                    /* Hover effect */
                    .btn:hover {
                        background-color: #0056b3;
                        /* Darker blue */
                        border-color: #0056b3;
                        /* Darker border */
                    }
                </style>
            </head>

            <body>
                <div class="container">
                    <div style="text-align: center;">
                        <h1>Reset Password</h1>
                    </div>
                    <h2>Halo!</h2>
                    <p>Anda menerima email ini karena kami menerima permintaan reset password atas email ini.</p>
                    <div style="text-align: center;">
                    <a class="btn" href="' . $tokenlink . '">Reset Password</a>
                    </div>
                    <p>Link ini akan kadaluarsa dalam 60 menit.</p>
                    <p >Jika anda tidak mengenali aktivitas ini, anda dapat mengabaikan email ini. Atau anda dapat <a
                    href="' . $loginurl . '">login</a> lalu mengubah password anda.
                    </p>
                    <br>
                    <br>
                    <p>Salam,</p>
                    <p>Websiteku</p>
                </div>
            </body>

            </html>
            ';

            Email::sendEmail($recipientEmail, $subject, $body);

            $data['judul'] = 'Forgot Password';
            $this->view('components/header', $data);
            $this->view('auth/emailsent', $data);
            $this->view('components/footer');
        }
    }

    public function resetpassword($username, $token)
    {
        if ($this->model('User')->checkExistToken($token)) {
            $tokentime = new Datetime($this->model('User')->getTokenTimestamp($token), new DateTimeZone('Asia/Jakarta'));
            $tokentime = $tokentime->getTimestamp();
            $currentTime = new DateTime();
            $currentTime = $currentTime->getTimestamp();
            if (($currentTime - $tokentime) > 3600) {
                Swal::setSwal('Gagal', 'Link telah kadaluarsa', 'error');
                $this->model('User')->deleteToken($token);
                header('Location: ' . BASEURL . '/auth');
                exit;
            } else {
                $data['judul'] = 'Reset Password';
                $data['username'] = $username;
                $data['token'] = $token;
                $this->view('components/header', $data);
                $this->view('auth/resetpassword', $data);
                $this->view('components/footer');
            }
        } else {
            Swal::setSwal('Gagal', 'Link tidak sesuai atau telah kadaluarsa', 'error');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function updatepassword($username, $token)
    {
        if (strlen($_POST['password']) < 8 || !preg_match('/\d/', $_POST['password'])) {
            Swal::setSwal('Gagal', 'Password harus minimal 8 karakter dan minial satu angka', 'error');
            header('Location: ' . BASEURL . '/auth/resetpassword/' . $username . '/' . $token);
            exit;
        }

        // Check if password and confirm password match
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            Swal::setSwal('Gagal', 'Password tidak sesuai', 'error');
            header('Location: ' . BASEURL . '/auth/resetpassword/' . $username . '/' . $token);
            exit;
        }
        if ($this->model('User')->updatePasswordUser($username, $_POST['password']) > 0) {
            if ($this->model('User')->deleteToken($token) > 0) {
                Swal::setSwal('Sukses', 'Password berhasil diupdate', 'success');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        }
    }

    public function signout()
    {
        unset($_SESSION['username']);
        header('Location: ' . BASEURL . '/auth');
    }
}
