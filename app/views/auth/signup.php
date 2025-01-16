<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['judul'] ?></title>
    <link href="<?= BASEURL ?>/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
?>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center fs-5">
                        Daftar Akun
                    </div>
                    <div class="card-body">
                        <form id="registerForm" action="<?= BASEURL ?>/auth/register" method="POST">
                            <div class="mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required
                                    value="<?php echo isset($_SESSION['formData']['username']) ? htmlspecialchars($_SESSION['formData']['username']) : ''; ?>" autofocus>
                            </div>
                            <div class="mb-2">
                                <label for="fullname" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required
                                    value="<?php echo isset($_SESSION['formData']['fullname']) ? htmlspecialchars($_SESSION['formData']['fullname']) : ''; ?>">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="<?php echo isset($_SESSION['formData']['email']) ? htmlspecialchars($_SESSION['formData']['email']) : ''; ?>">
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-info text-dark" type="button" id="button-addon2" onclick="togglePassword()">
                                        <i class="bi bi-eye" id="icon-password"></i></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                            <div class="row">
                                <div class="col text-start mt-2">
                                    Sudah punya akun? <a href="<?= BASEURL ?>/auth">Login</a>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-success" type="submit">Daftar</button>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['formData']); ?>