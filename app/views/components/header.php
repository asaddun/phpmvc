<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Websiteku | <?php echo $data['judul'] ?></title>
    <link href="<?= BASEURL ?>/bootstrap-5.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/fontawesome-6.7.2/css/all.min.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/css/style.css" rel="stylesheet">
    <script>
        const BASEURL = "<?php echo BASEURL; ?>";
    </script>
    <script src="<?= BASEURL ?>/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>

<?php
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
// var_dump($url);
?>

<body>
    <?php if (isset($_SESSION['username'])): ?>
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column p-3 shadow">
            <a href="<?= BASEURL ?>" class="logo text-center mb-4"><i class="fa-solid fa-globe me-2"></i>Websiteku</a>
            <ul class="nav nav-pills flex-column mb-auto">

                <!-- Ticket Menu -->
                <div class="menu-title">Ticket</div>
                <li class="nav-item">
                    <a class="nav-link <?= ($url[0] == "ticket" && $url[1] == "") ? "active" : "" ?>" href="<?= BASEURL ?>/ticket">
                        <div><i class="fa-solid fa-ticket"></i> My Ticket</div>
                    </a>
                    <a class="nav-link <?= ($url[0] == "ticket" && $url[1] == "queue") ? "active" : "" ?>" href="<?= BASEURL ?>/ticket/queue">
                        <div><i class="fa-solid fa-user-group"></i> Queue</div>
                    </a>
                    <a class="nav-link <?= ($url[0] == "ticket" && $url[1] == "history") ? "active" : "" ?>" href="<?= BASEURL ?>/ticket/history">
                        <div><i class="fa-solid fa-calendar-day"></i> History</div>
                    </a>
                </li>

                <!-- Service Menu -->
                <div class="menu-title">Service</div>
                <li class="nav-item">
                    <a class="nav-link <?= ($url[0] == "service" && $url[1] == "") ? "active" : "" ?>" href="<?= BASEURL ?>/service">
                        <div><i class="fa-solid fa-calendar-day"></i> History</div>
                    </a>
                    <a class="nav-link <?= ($url[0] == "service" && $url[1] == "order") ? "active" : "" ?>" href="<?= BASEURL ?>/service/order">
                        <div><i class="fa-solid fa-square-plus"></i> Order</div>
                    </a>
                    <a class="nav-link <?= ($url[0] == "service" && $url[1] == "price-list") ? "active" : "" ?>" href="<?= BASEURL ?>/service/price-list">
                        <div><i class="fa-solid fa-money-bills"></i> Price List</div>
                    </a>
                </li>

                <!-- Antrian Menu -->
                <div class="menu-title">Antrian</div>
                <li class="nav-item">
                    <a class="nav-link <?= ($url[0] == "queue" && $url[1] == "") ? "active" : "" ?>" href="<?= BASEURL ?>/queue">
                        <div><i class="fa-solid fa-tv"></i> Display</div>
                    </a>
                    <a class="nav-link <?= ($url[0] == "queue" && $url[1] == "register") ? "active" : "" ?>" href="<?= BASEURL ?>/queue/register">
                        <div><i class="fa-solid fa-square-plus"></i> Register</div>
                    </a>
                    <a href="<?= BASEURL ?>/queue/counter" class="nav-link <?= ($url[0] == "queue" && $url[1] == "counter") ? "active" : "" ?>">
                        <div><i class="fa-solid fa-microphone"></i> Counter</div>
                    </a>
                </li>
                <div class="menu-title">Other</div>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/employee" class="nav-link <?= $url[0] == "employee" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-user-group"></i> Employee</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/todo" class="nav-link <?= $url[0] == "todo" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-list-check"></i> To Do List</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/meeting" class="nav-link <?= $url[0] == "meeting" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-users"></i> Meeting</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/book" class="nav-link <?= $url[0] == "book" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-book"></i> Bookstore</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/locker" class="nav-link <?= $url[0] == "locker" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-door-closed"></i> Locker</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/version" class="nav-link <?= $url[0] == "version" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-table-list"></i> Version</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/settings" class="nav-link <?= $url[0] == "settings" ? "active" : "" ?>">
                        <div><i class="fa-solid fa-gear"></i> Settings</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASEURL ?>/auth/signout" class="nav-link">
                        <div><i class="fa-solid fa-right-from-bracket"></i> Logout</div>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="sidebar-overlay" style="display: none;"></div>


        <main class="main d-flex flex-column">
            <!-- Navbar -->
            <nav class="navbar navbar-expand bg-white px-3 shadow-sm" style="height: 60px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button" id="sidebarToggle">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="container py-5 flex-grow-1 d-flex flex-column">
            <?php endif; ?>