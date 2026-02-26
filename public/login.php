<head>
  <title>Inloggen - Luminos</title>
</head>

<?php require_once __DIR__ . '/assets/head.php'; ?>
<?php require_once __DIR__ . '/assets/header.php'; ?>

<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

AuthController::login();
?>


<form method="POST">
  <input name="email" type="email" required>
  <input name="password" type="password" required>
  <button>Login</button>
</form>

<?php require_once __DIR__ . '/assets/footer.php'; ?>