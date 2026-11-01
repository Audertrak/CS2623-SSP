# COPILOT_NOTES.md - Week 3

## Copilot in a Coal Mine

#### `filter_input()` vs `$_POST`

The assignment instructions ask: "What is the difference between `filter_input` and `$_POST` in PHP?"

> [!NOTE] 🤖 Copilot Says:
> `$_POST` is a PHP superglobal array that contains values submitted in the request body with the POST method. It gives direct access to the submitted values, but it does not validate or sanitize them.
>
> `filter_input()` reads a value from an external input source, such as `INPUT_POST`, and can apply a filter while it reads the value. For example, `FILTER_VALIDATE_EMAIL` can check whether an email value has a valid format, and `FILTER_VALIDATE_INT` can check whether a value is an integer. It is not a replacement for output escaping, so submitted values still need `htmlspecialchars()` before they are displayed.

This explains why SSP05 uses `filter_input()` for form processing instead of reading fields directly from `$_POST`.

## User enhancement: session security note

Page 6 asks us to note `session_regenerate_id()` for future login work. This function creates a new session identifier after successful authentication while preserving the session data. It helps reduce session fixation risk. SSP05 has no login or session code, so the function is documented here but is not added to these forms.

## Ch06 - Debugging

| # | File | Copilot suggestion | Decision | Notes |
|---|---|---|---|---|
| 1 | SSP05_1.php | Use `php -l` to find syntax errors before browser testing. | ACCEPTED | The syntax check passed before the page was checked as HTML. |
| 2 | SSP05_2.php | Use a safe default when invalid quantity input is received. | IMPROVED | The page validates the integer and replaces invalid or less-than-one values with `1`. |

## Ch07 - Form Data

| # | File | Copilot suggestion | Decision | Notes |
|---|---|---|---|---|
| 3 | SSP05_1.php | Read form fields with `filter_input()` instead of direct `$_POST` access. | ACCEPTED | All seven fields use `filter_input()`, and no direct `$_POST` access remains. |
| 4 | SSP05_1.php | Echo submitted values without escaping. | REJECTED | Every submitted value uses `htmlspecialchars()` before output. Comments use `nl2br()` after escaping. |
| 5 | SSP05_2.php | Read each option with a separate checkbox test. | IMPROVED | The options use one array with `FILTER_REQUIRE_ARRAY`, then a `foreach` loop displays the selected values. |

## Ch21 - Security Awareness

| # | File | Copilot suggestion | Decision | Notes |
|---|---|---|---|---|
| 6 | SSP05_1.php and SSP05_2.php | Treat every submitted value as safe after reading it. | REJECTED | The pages validate email and quantity, and escape every submitted value at the output site. |
| 7 | SSP05_2.php | Use direct string output for the order summary. | IMPROVED | The summary escapes customer, product, payment, quantity, options, and instructions. |
| 8 | SSP05_1.php and SSP05_2.php | Add database login code to these pages. | REJECTED | SSP05 has no database, so prepared statements and session login code are not part of this assignment. |
