<?php
declare(strict_types=1);

class ValidationException extends RuntimeException
{
}

class FormatException extends ValidationException
{
}

function validateContact(array $data): array
{
    $errors = [];

    if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }
    if (!filter_var($data['website'] ?? '', FILTER_VALIDATE_URL)) {
        $errors[] = 'Invalid website URL.';
    }
    if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $data['phone'] ?? '')) {
        $errors[] = 'Phone must be in format 555-555-5555.';
    }
    if (!preg_match('/^\d{5}(-\d{4})?$/', $data['zip'] ?? '')) {
        $errors[] = 'ZIP must be 5 digits or ZIP+4.';
    }
    if (filter_var($data['age'] ?? null, FILTER_VALIDATE_INT) === false) {
        $errors[] = 'Age must be a whole number.';
    }
    if (!preg_match('/^[A-Z]{2}\d{4}$/', $data['product_code'] ?? '')) {
        throw new FormatException('Product code must use two uppercase letters and four digits.');
    }
    if ($errors !== []) {
        throw new ValidationException(implode(' | ', $errors));
    }

    return $data;
}

$fields = ['email', 'website', 'phone', 'zip', 'age', 'product_code', 'message'];
$data = [];
foreach ($fields as $field) {
    $value = filter_input(INPUT_POST, $field, FILTER_UNSAFE_RAW);
    $data[$field] = is_string($value) ? trim($value) : '';
}
$result = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $result = validateContact($data);
    } catch (FormatException $exception) {
        $error = $exception->getMessage();
    } catch (ValidationException $exception) {
        $error = $exception->getMessage();
    } catch (RuntimeException $exception) {
        $error = 'System error: ' . $exception->getMessage();
    } finally {
        error_log('Contact form processed at ' . date('Y-m-d H:i:s'));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cunkle, Timothy">
    <meta name="description" content="CS2623 Server-Side Programming">
    <title>CS2623 - Exercise 15-1 Regex and Errors</title>
  </head>

  <body>
    <header>
      <h1>CS2623 Server-Side Programming</h1>
    </header>

    <main>
      <h1>Contact Form Validation</h1>

      <?php if ($error !== ''): ?>
        <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
      <?php endif; ?>

      <?php if ($result !== null): ?>
        <p>All fields valid. Ready to save.</p>
        <ul>
          <li>Email: <?= htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8') ?></li>
          <li>Website: <?= htmlspecialchars($result['website'], ENT_QUOTES, 'UTF-8') ?></li>
          <li>Phone: <?= htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8') ?></li>
          <li>ZIP: <?= htmlspecialchars($result['zip'], ENT_QUOTES, 'UTF-8') ?></li>
          <li>Age: <?= (int) $result['age'] ?></li>
          <li>Product code: <?= htmlspecialchars($result['product_code'], ENT_QUOTES, 'UTF-8') ?></li>
          <li>Message: <?= nl2br(htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8')) ?></li>
        </ul>
      <?php endif; ?>

      <form method="post">
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
        <label>Website: <input type="url" name="website" value="<?= htmlspecialchars($data['website'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
        <label>Phone: <input type="text" name="phone" value="<?= htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
        <label>ZIP: <input type="text" name="zip" value="<?= htmlspecialchars($data['zip'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
        <label>Age: <input type="number" name="age" value="<?= htmlspecialchars($data['age'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
        <label>Product code: <input type="text" name="product_code" value="<?= htmlspecialchars($data['product_code'], ENT_QUOTES, 'UTF-8') ?>"></label><br>
        <label>Message:<br>
          <textarea name="message" rows="4" cols="40"><?= htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </label><br>
        <button type="submit">Validate</button>
      </form>
    </main>

    <footer>
      <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>

  </body>

</html>
