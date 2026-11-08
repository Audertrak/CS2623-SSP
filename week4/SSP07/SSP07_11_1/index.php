<?php
declare(strict_types=1);

$fruits = ['apple', 'banana', 'cherry', 'date', 'elderberry'];
$search = filter_input(INPUT_POST, 'search', FILTER_UNSAFE_RAW);
$search = is_string($search) ? trim($search) : '';
$message = '';
$sorted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // reject unsafe searches before checking the fruit list
    if (isset($_POST['sort'])) {
        sort($fruits);
        $sorted = true;
    } elseif ($search !== '') {
        if (!preg_match('/^[A-Za-z]+$/', $search)) {
            $message = 'Search must contain letters only.';
        } else {
            $found = in_array($search, $fruits, true);
            $message = $found ? 'Found: ' . $search : 'Not found: ' . $search;
        }
    }
}

$upper = array_map(fn(string $fruit): string => strtoupper($fruit), $fruits);
// keep only fruits that meet the assignment length rule
$filtered = array_filter($fruits, fn(string $fruit): bool => strlen($fruit) >= 6);
$catalog = [
    ['id' => 1, 'name' => 'Apple', 'price' => 1.29],
    ['id' => 2, 'name' => 'Banana', 'price' => 0.49],
    ['id' => 3, 'name' => 'Cherry', 'price' => 2.99],
    ['id' => 4, 'name' => 'Dragonfruit', 'price' => 4.25],
];
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cunkle, Timothy">
    <meta name="description" content="CS2623 Server-Side Programming">
    <title>CS2623 - Exercise 11-1 Arrays</title>
  </head>

  <body>
    <header>
      <h1>CS2623 Server-Side Programming</h1>
    </header>

    <main>
      <h1>Fruit Array Demo</h1>

      <form method="post">
        <label for="search">Search fruit:</label>
        <input id="search" type="text" name="search"
              value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">Search</button>
        <button type="submit" name="sort" value="1">Sort A-Z</button>
      </form>

      <?php if ($message !== ''): ?>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
      <?php endif; ?>

      <h2><?= $sorted ? 'Sorted List' : 'Original List' ?> (<?= htmlspecialchars((string) count($fruits), ENT_QUOTES, 'UTF-8') ?> items)</h2>
      <ul>
        <?php foreach ($fruits as $fruit): ?>
          <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
      </ul>

      <h2>Uppercase (array_map + arrow function)</h2>
      <ul>
        <?php foreach ($upper as $fruit): ?>
          <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
      </ul>

      <h2>Fruits with at least six characters</h2>
      <ul>
        <?php foreach ($filtered as $fruit): ?>
          <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
      </ul>

      <h2>Catalog</h2>
      <table>
        <caption>Product catalog</caption>
        <tr><th scope="col">ID</th><th scope="col">Name</th><th scope="col">Price</th></tr>
        <?php foreach ($catalog as $row): ?>
          <tr>
            <td><?= htmlspecialchars((string) $row['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>$<?= htmlspecialchars(number_format((float) $row['price'], 2), ENT_QUOTES, 'UTF-8') ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </main>

    <footer>
      <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>

  </body>

</html>
