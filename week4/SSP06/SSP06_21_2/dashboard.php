<?php
declare(strict_types=1);
require 'auth.php';
// convert server time to the course timezone before display
$loginTime = (new DateTimeImmutable('@' . (int) $_SESSION['login_at']))
    ->setTimezone(new DateTimeZone('America/Chicago'));
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
      <p>Logged in at: <?= htmlspecialchars($loginTime->format('g:i A'), ENT_QUOTES, 'UTF-8') ?></p>
      <p><a href="profile.php">Profile</a></p>
      <p><a href="../SSP06_23_1/index.php">Shopping cart</a></p>
      <p><a href="logout.php">Log out</a></p>
    </main>
  </body>
</html>
