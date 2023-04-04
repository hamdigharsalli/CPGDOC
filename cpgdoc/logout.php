<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("Location: login");
    exit;
}
