<?php require_once __DIR__ . '/assets/head.php'; ?>
<?php require_once __DIR__ . '/assets/header.php'; ?>

<head>
  <title>Account - Luminos</title>
  <link rel="stylesheet" href="/public/assets/css/dashboard.css">
</head>

<?php
require_once __DIR__ . '/../App/Helpers/auth_check.php';
requireLogin();

$user = $_SESSION['user'];
?>

<title>Account - Luminos</title>

<div class="dashboard">

    <div class="card">
        <h2>
            Welkom terug,
            <span class="username">
                <?= htmlspecialchars($user['username']) ?>
            </span> 👋
        </h2>

        <p>Uw account dashboard</p>
    </div>

    <div class="stats-grid">

        <div class="stat-box">
            <div class="stat-title">Recente Bestelling</div>
            <div class="stat-value" style="font-size:16px">
                <?= htmlspecialchars($user['email']) ?>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-title">Account aangemaakt op</div>
            <div class="stat-value" style="font-size:18px">
                <?= date("d M, Y", strtotime($user['created_at'])) ?>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-title">Email</div>
            <div class="stat-value" style="font-size:16px">
                <?= htmlspecialchars($user['email']) ?>
            </div>
        </div>

        

    </div>

</div>

<?php require_once __DIR__ . '/assets/footer.php'; ?>