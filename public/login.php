<?php require_once __DIR__ . '/assets/head.php'; ?>
<?php require_once __DIR__ . '/assets/header.php'; ?>
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

AuthController::login();
?>

<?php if (!empty($_SESSION['error'])): ?>
  <div style="color:#ff6b6b; margin:1rem 0; text-align:center;">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>

<head>
  <title>Inloggen - Luminos</title>
</head>




<section class="auth-section">
  <div class="auth-card">
    <h2>Login to Luminos</h2>

    <form method="POST" class="auth-form">
      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-row">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <div class="auth-switch">
      No account yet?
      <a href="/register">Create one</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/assets/footer.php'; ?>