<?php
/*
 * functions_ssp03.php - CS2623 SSP03
 * Prints the weekly planner table from the schedule functions.
 *
 * NOTE TO THE INSTRUCTOR: the course server Apollo runs PHP 5, so this
 * file keeps PHP 5 syntax. Each affected line sits next to a comment
 * that shows the PHP 8 form the assignment prescribes. The PHP 8 draft
 * of this file is also in the Git history (commit 5e7c4ce).
 */

// PHP 8 version: declare(strict_types=1);

/**
 * Open the weekly planner table and print its headings.
 */
// PHP 8 version: function fn_tableOpen(string $caption): void
function fn_tableOpen($caption)
{
    echo '<table border="1" cellpadding="6" cellspacing="0">';
    echo '<tr style="background-color:#1B2A6B;color:#FFFFFF;">';
    echo '  <th colspan="3">';
    echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');
    echo '  </th>';
    echo '</tr>';
    echo '<tr style="background-color:#006B7D;color:#FFFFFF;">';
    echo '<th>Day</th>';
    echo '<th>Details</th>';
    echo '<th>Time</th>';
    echo '</tr>';
}

/**
 * Close the weekly planner table.
 */
// PHP 8 version: function fn_tableClose(): void
function fn_tableClose()
{
    echo '</table>';
}

/**
 * Print the current day's highlighted planner row.
 */
// PHP 8 version: function fn_tableRowCurrent(string $day, string $details, string $time): void
function fn_tableRowCurrent($day, $details, $time)
{
    echo '<tr style="background-color:#FFFF66;">';
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

/**
 * Print a normal planner row.
 */
// PHP 8 version: function fn_tableRow(string $day, string $details, string $time): void
function fn_tableRow($day, $details, $time)
{
    echo '<tr>';
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

/**
 * Return the weekday name for a number from one through seven.
 */
// PHP 8 version: function fn_dayOfWeek(int $day_num): string
function fn_dayOfWeek($day_num)
{
    if ($day_num === 1) {
        return 'Monday';
    } elseif ($day_num === 2) {
        return 'Tuesday';
    } elseif ($day_num === 3) {
        return 'Wednesday';
    } elseif ($day_num === 4) {
        return 'Thursday';
    } elseif ($day_num === 5) {
        return 'Friday';
    } elseif ($day_num === 6) {
        return 'Saturday';
    } elseif ($day_num === 7) {
        return 'Sunday';
    } else {
        return 'Unknown';
    }
}

/**
 * Return the scheduled activity for a weekday number.
 */
// PHP 8 version: function fn_dayDetails(int $day_num): string
function fn_dayDetails($day_num)
{
    switch ($day_num) {
        case 1:
            // Work runs 6:00 AM to 4:30 PM Monday through Thursday,
            // so the study block sits after the shift.
            return 'Work 6:00 AM-4:30 PM, then chapter reading';
        case 2:
            return 'Work 6:00 AM-4:30 PM, then SSP03 library work';
        case 3:
            return 'Work 6:00 AM-4:30 PM, then conditionals review';
        case 4:
            return 'Work 6:00 AM-4:30 PM, then SSP04 exercises';
        case 5:
            return 'Quiz review and office hours';
        case 6:
            return 'Course project work';
        case 7:
            return 'Rest day';
        default:
            return 'No schedule';
    }
}

/**
 * Return the scheduled time for a weekday number.
 */
// PHP 8 version: function fn_dayTime(int $day_num): string
function fn_dayTime($day_num)
{
    if ($day_num === 1 || $day_num === 3) {
        return '5:30 PM - 7:30 PM';
    } elseif ($day_num === 2 || $day_num === 4) {
        return '5:30 PM - 8:30 PM';
    } elseif ($day_num === 5) {
        return '9:00 AM - 11:00 AM';
    } elseif ($day_num === 6 || $day_num === 7) {
        return 'Flexible';
    } else {
        return 'TBD';
    }
}
