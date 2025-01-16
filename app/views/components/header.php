<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Websiteku | <?php echo $data['judul'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/css/style.css" rel="stylesheet">
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

<body>
    <?php if (isset($_SESSION['username'])): ?>
        <div class="navbar bg-dark d-block d-md-none">
            <div class="container-fluid">
                <button id="toggleButton" class="btn btn-outline-light" onclick="toggleSidebar()">☰</button>
                <span class="navbar-brand mb-0 h1 text-white ms-auto"><?= $data['judul'] ?></span>
            </div>
        </div>
        <div class="d-flex" style="height: 100vh;">
            <div id="sidebar" class="col-md-2 pe-0 bg-dark d-none d-md-flex flex-column">
                <nav class="nav flex-column flex-grow-1">
                    <a class="nav-link text-white fs-4" href="<?= BASEURL ?>">Websiteku</a>
                    <a class="nav-link text-white <?= ($url[0] == 'employee') ? 'active' : '' ?>" href="<?= BASEURL ?>/employee">Employee</a>
                    <a class="nav-link text-white <?= ($url[0] == 'todo') ? 'active' : '' ?>" href="<?= BASEURL ?>/todo">To Do List</a>
                    <!-- dropdown -->
                    <a class="nav-link dropdown-toggle text-white <?= ($url[0] == 'ticket') ? 'active' : '' ?>" href="#" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#ticketsubmenu">Ticket</a>
                    <!-- dropdown menu -->
                    <div class="sub-menu collapse" id="ticketsubmenu">
                        <a class="nav-link text-white <?= ($url[0] == 'ticket' && $url[1] == '') ? 'active' : '' ?>" href="<?= BASEURL ?>/ticket">My Ticket</a>
                        <a class="nav-link text-white <?= ($url[1] == 'queue') ? 'active' : '' ?>" href="<?= BASEURL ?>/ticket/queue">Queue</a>
                        <a class="nav-link text-white <?= ($url[1] == 'history') ? 'active' : '' ?>" href="<?= BASEURL ?>/ticket/history">History</a>
                    </div>
                    <!-- dropdown -->
                    <a class="nav-link dropdown-toggle text-white <?= ($url[0] == 'map') ? 'active' : '' ?>" href="#" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#submenu">Map</a>
                    <!-- dropdown menu -->
                    <div class="sub-menu collapse" id="submenu">
                        <a class="nav-link text-white <?= ($url[0] == 'map' && $url[1] == '') ? 'active' : '' ?>" href="<?= BASEURL ?>/map">The Peninsula</a>
                        <a class="nav-link text-white <?= ($url[1] == '#') ? 'active' : '' ?>" href="#">Link</a>
                    </div>
                    <!-- end dropdown menu -->
                    <a class="nav-link text-white <?= ($url[0] == 'settings') ? 'active' : '' ?>" href="<?= BASEURL ?>/settings">Settings</a>
                    <div class="mt-auto"></div>
                    <a class="nav-link text-white" href="<?= BASEURL ?>/auth/signout">Logout</a>
                </nav>
            </div>

            <main class="col-md-10 mt-3 p-0">
            <?php endif; ?>