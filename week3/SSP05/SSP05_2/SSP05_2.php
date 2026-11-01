<?php
declare(strict_types=1);

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD') ?? 'GET';
$cust_name = '';
$product = '';
$quantity = 1;
$options = [];
$instructions = '';
$payment = 'none';

if ($method === 'POST') {
    $cust_name = filter_input(INPUT_POST, 'cust_name') ?? '';
    $product = filter_input(INPUT_POST, 'product') ?? '';
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    if ($quantity === false || $quantity === null || $quantity < 1) {
        $quantity = 1;
    }
    $options = filter_input(
        INPUT_POST,
        'options',
        FILTER_SANITIZE_SPECIAL_CHARS,
        FILTER_REQUIRE_ARRAY
    ) ?? [];
    $instructions = filter_input(INPUT_POST, 'instructions') ?? '';
    $payment = filter_input(INPUT_POST, 'payment') ?? 'none';
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cunkle, Timothy">
    <meta name="description" content="CS2623 Server-Side Programming">
    <title>CS2623 - Exercise 7-2 Product Order</title>
  </head>

  <body>
    <header>
      <h1>CS2623 Server-Side Programming</h1>
    </header>

    <main>
      <h1>Exercise 7-2: Product Order</h1>

      <form action="SSP05_2.php" method="post">
        <p>
          <label for="cust_name">Customer Name:</label>
          <input type="text" id="cust_name" name="cust_name" required>
        </p>

        <p>
          <label for="product">Product:</label>
          <select id="product" name="product">
            <option value="notebook">Notebook - $8.00</option>
            <option value="backpack">Backpack - $35.00</option>
            <option value="headphones">Headphones - $50.00</option>
            <option value="keyboard">Keyboard - $65.00</option>
          </select>
        </p>

        <p>
          <label for="quantity">Quantity:</label>
          <input type="text" id="quantity" name="quantity" required>
        </p>

        <fieldset>
          <legend>Options and Add-ons</legend>
          <label>
            <input type="checkbox" name="options[]" value="gift-wrap">
            Gift wrap
          </label>
          <label>
            <input type="checkbox" name="options[]" value="express-shipping">
            Express shipping
          </label>
          <label>
            <input type="checkbox" name="options[]" value="insurance">
            Insurance
          </label>
        </fieldset>

        <p>
          <label for="instructions">Special Instructions:</label>
          <textarea id="instructions" name="instructions" rows="5" cols="40"></textarea>
        </p>

        <fieldset>
          <legend>Payment Method</legend>
          <label>
            <input type="radio" name="payment" value="credit">
            Credit card
          </label>
          <label>
            <input type="radio" name="payment" value="debit">
            Debit card
          </label>
          <label>
            <input type="radio" name="payment" value="paypal">
            PayPal
          </label>
        </fieldset>

        <button type="submit">Place Order</button>
      </form>

      <?php if ($method === 'POST'): ?>
        <h2>Order Summary</h2>
        <p><strong>Customer:</strong>
          <?php echo htmlspecialchars($cust_name, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Product:</strong>
          <?php echo htmlspecialchars($product, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Quantity:</strong>
          <?php echo htmlspecialchars((string) $quantity, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Payment:</strong>
          <?php echo htmlspecialchars($payment, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Selected Options:</strong></p>
        <ul>
          <?php foreach ($options as $option): ?>
            <li><?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?></li>
          <?php endforeach; ?>
        </ul>
        <p><strong>Instructions:</strong><br>
          <?php echo nl2br(htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8')); ?></p>
      <?php endif; ?>
    </main>

    <footer>
      <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>

  </body>

</html>
