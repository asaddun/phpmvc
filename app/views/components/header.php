<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Websiteku | <?php echo $data['judul'] ?></title>
    <link href="<?= BASEURL ?>/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        const BASEURL = "<?php echo BASEURL; ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
// var_dump($url);
?>

<body class="layout-fixed">
    <?php if (isset($_SESSION['username'])): ?>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav ps-3">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?= BASEURL ?>" class="brand-link">
                <i class="fa-solid fa-globe"></i>
                <span class="brand-text font-weight-light">Websiteku</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="<?= BASEURL ?>/employee" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Employee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL ?>/todo" class="nav-link">
                                <i class="fa-solid fa-list-check"></i>
                                <p>To Do List</p>
                            </a>
                        </li>
                        <!-- SubMenu -->
                        <li class="nav-item"> <!-- Tambahkan 'menu-open' jika ingin terbuka by default -->
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-ticket"></i>
                                <p>
                                    Ticket
                                    <i class="right fas fa-angle-left"></i> <!-- Panah Indikator -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/ticket" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>My Ticket</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/ticket/queue" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Queue</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/ticket/history" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- SubMenu -->
                        <li class="nav-item"> <!-- Tambahkan 'menu-open' jika ingin terbuka by default -->
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-fire"></i>
                                <p>
                                    Problem
                                    <i class="right fas fa-angle-left"></i> <!-- Panah Indikator -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/problem" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/problem/queue" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Queue</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/problem/history" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- SubMenu -->
                        <li class="nav-item"> <!-- Tambahkan 'menu-open' jika ingin terbuka by default -->
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <p>
                                    Service
                                    <i class="right fas fa-angle-left"></i> <!-- Panah Indikator -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/service" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Booking</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASEURL ?>/service/history" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL ?>/settings" class="nav-link">
                                <i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL ?>/auth/signout" class="nav-link">
                                <i class="fa-solid fa-door-open"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>



        <div class="content-wrapper">
            <div class="content pt-3">
            <?php endif; ?>