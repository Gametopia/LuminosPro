<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{

    public static function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (User::findByEmail($_POST['email'])) {
                header("Location: /register");
                exit;
            }

            User::create(
                $_POST['username'],
                $_POST['email'],
                $_POST['password']
            );


            header("Location: /login");
            exit;
        }
    }

    public static function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = User::findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {

                session_regenerate_id(true);

                $_SESSION['user'] = $user;

                $_SESSION['user'] = $user;

                if ($user['role'] === 'admin') {
                    header("Location: admin/dashboard");
                } else {
                    header("Location: /account");
                }

                exit;
            }

            $_SESSION['error'] = "Ongeldige email of wachtwoord.";
            header("Location: /login");
            exit;
        }
    }
}