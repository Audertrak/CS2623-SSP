<?php
declare(strict_types=1);
require 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
  </head>
  <body>
    <header>
      <h1>Welcome, <?= htmlspecialchars((string) $_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</h1>
    </header>
    <main>
      <p>Logged in at: <?= htmlspecialchars(date('g:i A', (int) $_SESSION['login_at']), ENT_QUOTES, 'UTF-8') ?></p>
      <p><a href="profile.php">Profile</a></p>
      <p><a href="../SSP06_23_1/index.php">Shopping cart</a></p>
      <p><a href="logout.php">Log out</a></p>
    </main>
  </body>
</html>
