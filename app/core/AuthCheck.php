<?php

if (!isset($_SESSION['username'])) {
    // Menyimpan url tujuan sebelum login
    $targetPage = basename($_SERVER['REQUEST_URI']);
    // Mengarahkan user ke halaman login dengan parameter halaman tujuan sebelum login
    header('Location: ' . BASEURL . "/auth/$targetPage");
    exit;
}
