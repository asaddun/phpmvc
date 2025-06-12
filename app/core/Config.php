<?php

$protocol = 'http';

if (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
) {
    $protocol = 'https';
}
define('BASEURL', $protocol . '://' . $_SERVER['HTTP_HOST']);

//DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root1234');
define('DB_NAME', 'mydb');

//Email
define('Email_HOST', 'smtp.gmail.com');
define('Email_USER', 'test.asaddun@gmail.com');
define('Email_PASS', 'tfkjonuwvxjagybd');
define('Email_PORT', 587);
