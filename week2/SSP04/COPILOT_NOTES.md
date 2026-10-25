# COPILOT_NOTES.md - Week 2 SSP04

## SSP04 / Chapters 9 and 10

| # | File | Copilot suggestion | Decision | Notes |
|---|---|---|---|---|
| 1 | ex1_strings.php | Small `output_value()` helper for escaping | IMPROVED | The helper hid the escaping call inside a function. I removed it and put `htmlspecialchars($val, ENT_QUOTES, 'UTF-8')` right at each echo site, so every output line shows its own escape. |
| 2 | ex1_strings.php | Short echo tags `<?= ?>` in the table | REJECTED | Ch02 slide 76 says short tags are not allowed in this course. I rewrote each one as a full `<?php echo ... ?>` block. |
| 3 | ex1_strings.php | `str_contains()` usage | ACCEPTED | The check returns a boolean as required. I cast it to a text form before the escape, because `htmlspecialchars()` needs a string argument under strict types. |
| 4 | ex2_datetime.php | `new DateTime('now')` with no timezone | REJECTED | Apollo runs UTC, six hours ahead of Central. I kept `DateTimeZone('America/Chicago')` on every date, or the current day on the page would drift. |
| 5 | ex2_datetime.php | `createFromFormat('Y-m-d')` for the birthdate | ACCEPTED | I set the real date 1991-12-28 and confirmed `diff()` returns the age in years and days. |
| 6 | ex2_datetime.php | Countdown target | IMPROVED | I kept the sample end date 2026-12-15 for the countdown and put it in the label, so the number on the page always names the date it counts to. |
| 7 | ex1_strings.php | PHP 5 fallback for `str_contains()` | REJECTED | I temporarily used `strpos()` after Apollo reported that `str_contains()` was unavailable. The instructor confirmed that PHP 8 is the assignment target, so the final submitted exercise must use `str_contains()`. |
| 8 | ex1_strings.php, ex2_datetime.php | `declare(strict_types=1)` at the top | REJECTED | I temporarily commented out the directive while investigating Apollo. The instructor confirmed that PHP 8 is the assignment target, so the final submitted files must keep the declaration active. |
| 9 | ex1_strings.php, ex2_datetime.php | PHP 5 versions only | IMPROVED | I first kept PHP 5 running copies beside commented PHP 8 forms. The instructor clarified that separate versions are not required, so the final assignment should use one PHP 8 version. |
