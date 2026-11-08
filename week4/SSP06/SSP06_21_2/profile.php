<?php
declare(strict_types=1);
require 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
  </head>
  <body>
    <header><h1>Profile</h1></header>
    <main>
      <p>User: <?= htmlspecialchars((string) $_SESSION['user'], ENT_QUOTES, 'UTF-8') ?></p>
      <p><a href="dashboard.php">Dashboard</a></p>
      <p><a href="logout.php">Log out</a></p>
    </main>
  </body>
</html>
