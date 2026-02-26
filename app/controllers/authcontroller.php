<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{

    public static function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (User::findByEmail($_POST['email'])) {
                $_SESSION['error'] = "Email already exists.";
                header("Location: register.php");
                exit;
            }

            User::create(
                $_POST['username'],
                $_POST['email'],
                $_POST['password'] // send raw password
            );


            header("Location: login.php");
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

                header("Location: dashboard.php");
                exit;
            } 
            
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: login.php");
            exit;
        }
    }
}