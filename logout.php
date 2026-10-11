<?php
require_once __DIR__ . '/config.php';

if (isset($_SESSION['user'])) {
    session_unset();
    session_destroy();
}

redirect('login.php');
