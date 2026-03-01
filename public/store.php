<?php require_once __DIR__ . '/assets/head.php'; ?>
<?php require_once __DIR__ . '/assets/header.php'; ?>

<head>
  <title>Winkel - Luminos</title>
</head>


<main>
  <?php
  

  require __DIR__ . '/../vendor/autoload.php';

  use App\Models\Product;

  $products = Product::all();
  ?>
<section class="store-grid">
  <?php foreach ($products as $product): ?>
    <div class="store-card">
      <img class="store-image" src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
      <h3><?= htmlspecialchars($product['name']) ?></h3>
      <p class="price">€<?= $product['price'] ?></p>

      <form method="POST" action="cart">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <button class="btn btn-primary">Add to cart</button>
      </form>
    </div>
  <?php endforeach; ?>
</main>

<?php require_once __DIR__ . '/assets/footer.php'; ?>