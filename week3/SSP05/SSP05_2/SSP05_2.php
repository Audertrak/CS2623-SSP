<?php
declare(strict_types=1);
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
    </main>

    <footer>
      <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>

  </body>

</html>
