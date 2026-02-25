<?php

if (!isset($_SESSION['user']) ||
    $_SESSION['user']['role'] !== 'admin') {

    die("Access denied.");
}