<?php
/*
 * include_header.php - CS2623 SSP02
 * Prints the page heading.
 */
?>
<header>
  <h1>CS2623 <?php
    $server_name = isset($_SERVER['SERVER_NAME'])
        ? $_SERVER['SERVER_NAME']
        : 'Server-Side Programming';
    echo htmlspecialchars(
        $server_name,
        ENT_QUOTES,
        'UTF-8'
    );
  ?></h1>
</header>
