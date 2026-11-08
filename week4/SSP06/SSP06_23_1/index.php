<?php
declare(strict_types=1);
require '../SSP06_21_2/auth.php';

$products = [
    1 => ['id' => 1, 'name' => 'Fender Stratocaster', 'price' => 499.99],
    2 => ['id' => 2, 'name' => 'Gibson Les Paul', 'price' => 799.99],
    3 => ['id' => 3, 'name' => 'Martin D-28 Acoustic', 'price' => 1299.99],
    4 => ['id' => 4, 'name' => 'Ibanez RG550', 'price' => 299.99],
];

$_SESSION['cart'] ??= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
    if ($id !== false && $id !== null && isset($products[$id])) {
        if ($action === 'remove') {
            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) - 1;
            if ($_SESSION['cart'][$id] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        } else {
            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        }
    }
    header('Location: index.php');
    exit;
}

$itemCount = array_sum(array_map('intval', $_SESSION['cart']));
$total = 0.0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    if (isset($products[$id])) {
        $total += $products[$id]['price'] * $quantity;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 23-1 Product Catalog</title>
  </head>
  <body>
    <header>
      <h1>Product Catalog</h1>
      <p>Cart (<?= (int) $itemCount ?> items)</p>
    </header>
    <main>
      <!-- TODO (user): Log in first, add and remove products, clear the cart, and verify each result. -->
      <?php foreach ($products as $product): ?>
        <article>
          <h2><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h2>
          <p>$<?= number_format((float) $product['price'], 2) ?></p>
          <form method="post">
            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
            <button type="submit" name="action" value="add">Add to Cart</button>
          </form>
        </article>
      <?php endforeach; ?>

      <h2>Your Cart</h2>
      <?php if ($_SESSION['cart'] === []): ?>
        <p>Your cart is empty.</p>
      <?php else: ?>
        <table border="1">
          <tr><th scope="col">Product</th><th scope="col">Qty</th><th scope="col">Subtotal</th><th scope="col">Action</th></tr>
          <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
            <?php if (isset($products[$id])): ?>
              <tr>
                <td><?= htmlspecialchars($products[$id]['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= (int) $quantity ?></td>
                <td>$<?= number_format($products[$id]['price'] * $quantity, 2) ?></td>
                <td>
                  <form method="post">
                    <input type="hidden" name="product_id" value="<?= (int) $id ?>">
                    <button type="submit" name="action" value="remove">Remove one</button>
                  </form>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
          <tr><th colspan="2" scope="row">Total</th><td colspan="2">$<?= number_format($total, 2) ?></td></tr>
        </table>
      <?php endif; ?>
      <p><a href="cart_clear.php">Clear Cart</a></p>
      <p><a href="../SSP06_21_2/dashboard.php">Dashboard</a></p>
    </main>
  </body>
</html>
