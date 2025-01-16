<?php
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
?>
<a class="list-group-item list-group-item-action 
<?php
if ($url[0] == 'settings' && $url[1] == '') {
    echo 'active';
} else {
    echo '';
}
?>" href="<?= BASEURL ?>/settings">Informasi</a>
<a class="list-group-item list-group-item-action <?= ($url[1] == 'email') ? 'active' : '' ?>" href="<?= BASEURL ?>/settings/email">Ubah Email</a>
<a class="list-group-item list-group-item-action <?= ($url[1] == 'password') ? 'active' : '' ?>" href="<?= BASEURL ?>/settings/password">Reset Password</a>