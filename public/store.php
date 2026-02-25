<head>
  <title>Winkel - Luminos</title>
</head>

<?php require_once 'head.php'; ?>
<?php require_once 'header.php'; ?>

<main>
  <?php
session_start();
require '../vendor/autoload.php';

use App\Models\Product;

$products = Product::all();
?>

<?php foreach($products as $product): ?>
  <div>
    <h3><?= htmlspecialchars($product['name']) ?></h3>
    <p>€<?= $product['price'] ?></p>

    <form method="POST" action="cart.php">
      <input type="hidden" name="id" value="<?= $product['id'] ?>">
      <button>Add to cart</button>
    </form>
  </div>
<?php endforeach; ?>
</main>

<?php require_once 'footer.php'; ?>