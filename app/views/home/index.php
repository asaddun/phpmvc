<?php
if (!isset($_SESSION['username'])) {
    header('Location: ' . BASEURL . '/auth');
    exit;
}
?>
<div class="container">
    <h1>Selamat Datang di Websiteku</h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia fuga aliquam atque, odio labore praesentium? Eum inventore eos quam sint voluptatum totam quasi architecto omnis nostrum? Eaque ullam quibusdam cumque?</p>
</div>