<?php


function requireLogin()
{
    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }
}

function requireAdmin()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: /login");
        exit;
    }
}