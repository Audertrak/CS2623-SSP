<?php
declare(strict_types=1);

/*
 * ex1_strings.php - CS2623 SSP04
 * Prints a table of the string functions on a sample description.
 */
$description = 'PHP server-side programming supports practical web pages.';
$replacement = str_replace('practical', 'useful', $description);
$contains_php = str_contains($description, 'PHP');
$contains_text = $contains_php ? 'true' : 'false';
$lowercase = strtolower($description);
$uppercase = strtoupper($description);
$character_count = strlen($description);
$formatted_price = sprintf('$%.2f', 9.9);
$formatted_number = number_format(1000000);
$excerpt = substr($description, 37, 9);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Cunkle, Timothy">
  <meta name="description" content="CS2623 Server-Side Programming - SSP04">
  <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
  <title>CS2623 SSP04 Exercise 1: Cunkle</title>
</head>
<body>
  <header>
    <h1>SSP04 Exercise 1: String Functions</h1>
  </header>

  <main>
    <p>Original description:
      <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <table>
      <caption>PHP String Function Examples</caption>
      <tr>
        <th scope="col">Function</th>
        <th scope="col">Input</th>
        <th scope="col">Output</th>
      </tr>
      <tr>
        <td>str_replace()</td>
        <td>'practical' becomes 'useful'</td>
        <td><?php echo htmlspecialchars($replacement, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>str_contains()</td>
        <td>keyword 'PHP'</td>
        <td><?php echo htmlspecialchars($contains_text, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>strtolower()</td>
        <td>the description</td>
        <td><?php echo htmlspecialchars($lowercase, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>strtoupper()</td>
        <td>the description</td>
        <td><?php echo htmlspecialchars($uppercase, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>strlen()</td>
        <td>the description</td>
        <td><?php echo htmlspecialchars((string) $character_count, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>sprintf()</td>
        <td>9.9 with '$%.2f'</td>
        <td><?php echo htmlspecialchars($formatted_price, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>number_format()</td>
        <td>1000000</td>
        <td><?php echo htmlspecialchars($formatted_number, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
      <tr>
        <td>substr()</td>
        <td>position 37, length 9</td>
        <td><?php echo htmlspecialchars($excerpt, ENT_QUOTES, 'UTF-8'); ?></td>
      </tr>
    </table>
  </main>
</body>
</html>
