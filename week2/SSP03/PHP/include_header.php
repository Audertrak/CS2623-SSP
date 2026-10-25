<?php
/*
 * include_header.php - CS2623 SSP03
 * Prints the reusable document header and page heading.
 */

$server_name = isset($_SERVER['SERVER_NAME'])
    ? $_SERVER['SERVER_NAME']
    : 'Server-Side Programming';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Cunkle, Timothy">
  <meta name="description" content="CS2623 Server-Side Programming - SSP03">
  <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
  <title>CS2623 SSP03: Cunkle</title>
</head>
<body>
  <header>
    <h1>CS2623 <?php
      echo htmlspecialchars($server_name, ENT_QUOTES, 'UTF-8');
    ?> - Weekly Study Planner</h1>
  </header>
