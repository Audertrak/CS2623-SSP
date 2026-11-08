<?php
declare(strict_types=1);
session_start();
session_unset();
session_destroy();
setcookie('remembered_user', '', time() - 3600, '/');
header('Location: index.php');
exit;
