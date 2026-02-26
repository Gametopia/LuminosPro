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
    <h2>Account Aanmaken</h2>

    <form method="POST" class="auth-form">
      <div class="form-row">
        <label>Gebruikersnaam</label>
        <input type="text" name="username" required>
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-row">
        <label>Wachtwoord</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary">
        Registreren
      </button>
    </form>

    <div class="auth-switch">
      Heb je al een account?
      <a href="/login">Inloggen</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/assets/footer.php'; ?>