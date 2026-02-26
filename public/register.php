<?php require_once __DIR__ . '/assets/head.php'; ?>
<?php require_once __DIR__ . '/assets/header.php'; ?>
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

AuthController::register();


?>



<head>
  <title>Registreren - Luminos</title>
</head>

<section class="auth-section">
  <div class="auth-card">
    <h2>Create Your Account</h2>

    <form method="POST" class="auth-form">
      <div class="form-row">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-row">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary">
        Register
      </button>
    </form>

    <div class="auth-switch">
      Already have an account?
      <a href="/login">Login here</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/assets/footer.php'; ?>