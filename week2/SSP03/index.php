<?php
/*
 * index.php - CS2623 SSP03
 * Builds the weekly planner page from the function library.
 *
 * NOTE TO THE INSTRUCTOR: Apollo runs PHP 5, so the PHP 8 line
 * declare(strict_types=1) sits in a comment instead. On the local
 * PHP 8 server the active line goes back in at once.
 */

// PHP 8 version: declare(strict_types=1);

require_once __DIR__ . '/PHP/functions_ssp03.php';
require_once __DIR__ . '/PHP/include_header.php';

// The campus server runs UTC, so the local clock needs
// America/Chicago to highlight the row the campus week calls today.
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$current_day = (int) $now->format('N');

fn_tableOpen('CS-2623 Weekly Study Planner');

for ($day = 1; $day < 8; $day++) {
    $name = fn_dayOfWeek($day);
    $details = fn_dayDetails($day);
    $time = fn_dayTime($day);

    if ($day === $current_day) {
        fn_tableRowCurrent($name, $details, $time);
    } else {
        fn_tableRow($name, $details, $time);
    }
}

fn_tableClose();

require_once __DIR__ . '/PHP/include_footer.php';
?>
