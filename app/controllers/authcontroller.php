<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {

    public static function register() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (User::findByEmail($_POST['email'])) {
                die("Email already exists.");
            }

            User::create(
                $_POST['username'],
                $_POST['email'],
                $_POST['password']
            );

            header("Location: login.php");
            exit;
        }
    }

    public static function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = User::findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {

                session_regenerate_id(true);

                $_SESSION['user'] = $user;

                header("Location: index.php");
                exit;
            }

            die("Invalid login.");
        }
    }
}