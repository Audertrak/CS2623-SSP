# COPILOT_NOTES.md - Week 2 SSP03

## SSP03 / Chapters 8 and 13

| # | File | Copilot suggestion | Decision | Notes |
|---|---|---|---|---|
| 1 | functions_ssp03.php | `match` expression for `fn_dayOfWeek` | REJECTED | The assignment requires an `if`/`elseif` chain for the day names. I dismissed the suggestion and wrote the chain by hand. |
| 2 | functions_ssp03.php | `fn_tableOpen` HTML structure | ACCEPTED | I kept the caption row and the three column headings. I verified `htmlspecialchars($caption, ENT_QUOTES, 'UTF-8')` sits on the only variable in the function. |
| 3 | functions_ssp03.php | Sample weekly schedule rows | IMPROVED | Copilot echoed the sample from the assignment. I changed Mon-Thu to fit my full-time work shifts (6:00 AM-4:30 PM) and moved the study blocks to the evening, with Friday daytime free. |
| 4 | index.php | `for` loop over the seven days | ACCEPTED | The loop runs 1 through 7 and calls the three schedule functions each pass. I checked it covers Monday through Sunday. |
| 5 | index.php | Current-day highlight conditional | ACCEPTED | The branch picks `fn_tableRowCurrent` for today and `fn_tableRow` otherwise. I added `DateTimeZone('America/Chicago')` because Apollo runs UTC and the highlight would land on the wrong row without it. |
| 6 | functions_ssp03.php, index.php | PHP 5 adaptation for `declare(strict_types=1)` and typed signatures | REJECTED | I temporarily tested a PHP 5 adaptation after Apollo rejected the PHP 8 forms. The instructor confirmed that PHP 8 is the assignment target, so the final submitted files must keep strict types and typed signatures active. |
| 7 | functions_ssp03.php | PHP 8 forms at each affected site | IMPROVED | I first kept the PHP 8 forms in comments while investigating Apollo. The instructor confirmed that separate PHP 5 deployment copies are not required, so the final code should keep the PHP 8 forms active instead. |

## Include choice

I use `require_once` for the function library, the header, and the footer.

Both `include()` and `require()` pass control to another PHP file (Ch02, slide 56). The difference shows when the file is missing: `include()` prints a warning and the page tries to keep running, while `require()` raises a fatal error and stops (Ch02, slide 57). The `_once` forms load the file only on the first call, so a page that pulls in shared files twice cannot redefine the same functions.

My planner page breaks completely without `functions_ssp03.php`, because every row comes out of it, so a silent half-render from `include()` would only hide the fault from me. A fatal error at the right spot is the honest behaviour, which matches Ch02's guidance to use `require` over `include` for critical files, and Ch13 slide 32 uses `require_once` the same way to load a function library. `__DIR__` in the path pins the folder to the file's own directory, so the page does not depend on Apache's working folder.
