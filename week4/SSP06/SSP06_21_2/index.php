<?php
declare(strict_types=1);
session_start();

$users = [
    'admin' => password_hash('secret123', PASSWORD_DEFAULT),
    'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT),
];

$_SESSION['attempts'] ??= 0;
$error = '';
$rememberedUser = $_COOKIE['remembered_user'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
    $username = is_string($username) ? trim($username) : '';
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $password = is_string($password) ? $password : '';
    $remember = filter_input(INPUT_POST, 'remember', FILTER_VALIDATE_BOOL) ?? false;

    if ($_SESSION['attempts'] >= 3) {
        $error = 'This account is locked after three failed attempts.';
    } elseif (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['attempts'] = 0;
        session_regenerate_id(true);
        $_SESSION['user'] = $username;
        $_SESSION['login_at'] = time();
        if ($remember) {
            setcookie('remembered_user', $username, [
                'expires' => time() + (30 * 24 * 60 * 60),
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        } else {
            setcookie('remembered_user', '', time() - 3600, '/');
        }
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['attempts']++;
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 21-2 Login</title>
  </head>
  <body>
    <header><h1>Login</h1></header>
    <main>
      <!-- TODO (user): Test admin/secret123 and jsmith/php4life!, then test three failed attempts. -->
      <?php if ($error !== ''): ?>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
      <?php endif; ?>
      <form method="post">
        <label>Username:
          <input type="text" name="username" value="<?= htmlspecialchars($rememberedUser, ENT_QUOTES, 'UTF-8') ?>" autocomplete="username">
        </label><br>
        <label>Password:
          <input type="password" name="password" autocomplete="current-password">
        </label><br>
        <label><input type="checkbox" name="remember" value="1"> Remember me</label><br>
        <button type="submit">Log in</button>
      </form>
    </main>
  </body>
</html>
