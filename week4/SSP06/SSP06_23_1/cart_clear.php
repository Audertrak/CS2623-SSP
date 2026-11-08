<?php
declare(strict_types=1);
require_once __DIR__ . '/../SSP06_21_2/auth.php';
// remove the session cart before returning to the catalog
unset($_SESSION['cart']);
header('Location: index.php');
exit;
