<?php
declare(strict_types=1);

/*
 * ex2_datetime.php - CS2623 SSP04
 * Prints the current date and time and the age and countdown intervals.
 */
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$today_name = $now->format('l');
$today_date = $now->format('F j, Y');
$today_time = $now->format('g:i:s A');

// The campus server runs UTC, so every date on this page
// carries the campus time zone instead of the server clock.
$birth_str = '1991-12-28';
$birth_date = DateTime::createFromFormat('Y-m-d', $birth_str, $tz);
$age_interval = $birth_date->diff($now);

$end_date = new DateTime('2026-12-15', $tz);
$countdown = $now->diff($end_date);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Cunkle, Timothy">
  <meta name="description" content="CS2623 Server-Side Programming - SSP04">
  <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
  <title>CS2623 SSP04 Exercise 2: Cunkle</title>
</head>
<body>
  <header>
    <h1>SSP04 Exercise 2: Date and Time</h1>
  </header>

  <main>
    <p>Today is:
      <?php echo htmlspecialchars($today_name . ', ' . $today_date, ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <p>Current time (CDT):
      <?php echo htmlspecialchars($today_time, ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <p>Age in years:
      <?php echo htmlspecialchars((string) $age_interval->y, ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <p>Age in days:
      <?php echo htmlspecialchars((string) $age_interval->days, ENT_QUOTES, 'UTF-8'); ?>
    </p>
    <p>Days until semester end (2026-12-15):
      <?php echo htmlspecialchars((string) $countdown->days, ENT_QUOTES, 'UTF-8'); ?>
    </p>
  </main>
</body>
</html>
