<?php
require_once __DIR__ . '/config.php';

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
}

redirect('login.php');
