# COPILOTE_NOTES.md - CS 2623

> [!NOTE] **NOTE TO THE INSTRUCTOR:**
> I slightly deviated from the provided COPILOT_NOTES.md template as instrcutions state this file is to live at the repo root but also be updated weekly. Rather than the `Accepted`, `Rejected`, and `Improved` sections being at `h2` I have them set at `h3` so I can add future weeks as `h2` and retain full history. Please advise if you do not approve.

## Week 1

### ✅ Accepted

- I accepted the `require_once __DIR__ . '/PHP/file.php'` pattern for SSP02. I verified that `__DIR__` builds the include path from the current page folder, so the page does not depend on Apache's working folder.
- I accepted escaping dynamic values with `htmlspecialchars($value, ENT_QUOTES, 'UTF-8')`. I used it for the SSP02 server name, footer timestamp, loop counter, and hour value because these values are sent to the browser.

### ❌ Rejected

- I rejected the first SSP01 PHP test pattern that escaped the complete string `<p>Hello World (PHP Testing)</p>`. The browser showed the paragraph tags as text. I kept the `<p>` element in the page markup and escaped only the PHP-generated text.

### ✏️ Improved

- Copilot suggested `date("D M d Y H:i:s", getlastmod())` for the footer timestamp. I improved it to use `date('F j, Y, g:i a', filemtime($_SERVER['SCRIPT_FILENAME']))`. `filemtime()` reads the modification time of the page that the browser requested, even though the code runs in an included footer file. I also wrapped the formatted value in `htmlspecialchars()` before output.
- Apollo reported a parse error for the PHP null-coalescing operator (`??`) in `include_header.php`. I replaced `$_SERVER['SERVER_NAME'] ?? 'Server-Side Programming'` with an `isset()` check and a ternary expression. This keeps SSP02 compatible with the older PHP runtime on Apollo. I re-uploaded the page and verified the live page returned HTTP 200 with the table and footer.

### Copilot in a Coal Mine

Decided to give this a dedicated section with an attempt at a clever name based on https://en.wikipedia.org/wiki/Sentinel_species ("canary in a coal mine") since they feel like "sentinel" instructions. 

#### `require()` vs `include()`

Assignment instructions in the "Week 1 Template" section gave the following instructions: "Open Copilot Chat (Ctrl+Shift+I in VS Code) and type: "Explain the difference between require() and include() in PHP" — paste the explanation into your notes, then verify it against the textbook."

> [!NOTE] 🤖 Copilot Says:
> Both `require()` and `include()` load and evaluate another PHP file. The difference is how they handle failure:
> - `require()` produces a fatal error if the file cannot be loaded, so script execution stops. Use it for essential dependencies.
> - `include()` produces a warning if the file cannot be loaded, but script execution continues. Use it for optional content.
> 
> Both have `_once` variants (`require_once()` and `include_once()`) that prevent the same file from being loaded more than once.

Checks out as far as I can tell against the textbook.

#### Echo, echo, echo...

Explicit reason given in the assignment for using `htmlspecialchars()` is XSS prevention. If user input is echoed directly, a value such as `<script>alert("hacked")</script>` can run in every visitor's browser. `htmlspecialchars()` converts `<`, `>`, `"`, `'`, and `&` to HTML entities. For example, `<script>...</script>` becomes `&lt;script&gt;...`, which the browser shows as text instead of code. Any value from `$_GET`, `$_POST`, or `$_SERVER` must use `htmlspecialchars()` before it is echoed.

## Week 2

### ✅ Accepted

- I accepted Copilot's `fn_tableOpen` HTML structure for SSP03. I kept the caption row and the three column headings, and I verified that the caption uses `htmlspecialchars($caption, ENT_QUOTES, 'UTF-8')`.
- I accepted the `for` loop over the seven planner days. I checked that it runs from 1 through 7, calls the three schedule functions, and uses the highlighted-row function only for the current day.
- I accepted the `DateTimeZone('America/Chicago')` fix in SSP03 and SSP04. Apollo runs UTC, so the zone keeps the highlighted day and displayed dates correct for the college.
- I accepted `DateTime::createFromFormat('Y-m-d')` for the SSP04 birthdate. I verified that it works with `diff()` and provides the age in years and days.
- I accepted the `require_once` pattern for the SSP03 function library, header, and footer. I verified it loads each required file once and uses `__DIR__` so the paths do not depend on Apache's working folder.

### ❌ Rejected

- I rejected Copilot's `match` expression for `fn_dayOfWeek`. The assignment requires an `if`/`elseif` chain, so I wrote that control structure instead.
- I rejected the short echo tags `<?= ?>` in SSP04. Chapter 2, slide 76 says short tags are not allowed in this course, so I used full `<?php echo ... ?>` blocks.
- I rejected the timezone-less `new DateTime('now')` suggestion in SSP04. Apollo runs UTC, so the page uses `DateTimeZone('America/Chicago')`.
- I temporarily rejected the direct `str_contains()` call during the Apollo investigation because the old server reported that the PHP 8 function was unavailable. The instructor confirmed that PHP 8 is the assignment target, so the final submitted code must use `str_contains()` rather than the PHP 5 fallback.
- I temporarily rejected active `declare(strict_types=1)` and typed PHP 8 signatures during the Apollo investigation because the old server rejected them. The instructor confirmed that PHP 8 is the assignment target, so the final submitted code must keep the required PHP 8 forms active. No separate PHP 5 assignment copy is required.

### ✏️ Improved

- I improved the SSP04 escaping approach by removing the `output_value()` helper. The helper hid the security call, so I put `htmlspecialchars($value, ENT_QUOTES, 'UTF-8')` at each output site where the browser receives a value.
- I improved the SSP03 schedule to fit my four 10-hour work shifts from 6:00 AM to 4:30 PM Monday through Thursday. I moved the study blocks to the evenings, used Friday for quiz review and office hours, and left the weekend flexible.
- I improved the SSP04 countdown label by naming the target date, 2026-12-15, so the displayed number identifies the date it counts to.
- I improved the SSP03 reusable header and footer from the Week 1 pattern. The header keeps the escaped Apollo server-name fallback, and the footer keeps the escaped `filemtime()` timestamp and OCCC disclaimer while adding the Week 2 document structure.

## Week 3

### Copilot in a Coal Mine

#### `filter_input()` vs `$_POST`

The assignment instructions ask: "What is the difference between `filter_input` and `$_POST` in PHP?"

> [!NOTE] 🤖 Copilot Says:
> `$_POST` is a PHP superglobal array that contains values submitted in the request body with the POST method. It gives direct access to the submitted values, but it does not validate or sanitize them.
>
> `filter_input()` reads a value from an external input source, such as `INPUT_POST`, and can apply a filter while it reads the value. For example, `FILTER_VALIDATE_EMAIL` can check whether an email value has a valid format, and `FILTER_VALIDATE_INT` can check whether a value is an integer. It is not a replacement for output escaping, so submitted values still need `htmlspecialchars()` before they are displayed.

This explains why SSP05 uses `filter_input()` for form processing instead of reading fields directly from `$_POST`.

#### Xdebug with XAMPP on Windows

The assignment instructions ask: "How do I set up Xdebug with XAMPP on Windows?"

> [!NOTE] 🤖 Copilot Says:
> Install the PHP Debug extension in VS Code. In XAMPP, find the active PHP configuration file from the Apache Config menu and check the PHP version that Apache uses. Install an Xdebug build that matches that PHP version, thread safety setting, architecture, and PHP extension API.
>
> Add the Xdebug settings to the active `php.ini` file:
>
> ```ini
> zend_extension=xdebug
> xdebug.mode=debug
> xdebug.start_with_request=yes
> xdebug.client_host=127.0.0.1
> xdebug.client_port=9003
> ```
>
> Restart Apache after saving the file. In VS Code, create a PHP debug launch configuration that listens on port 9003. Set a breakpoint inside the POST block, start the listener, and submit the form. If VS Code does not pause, confirm that Apache uses the edited `php.ini`, the Xdebug extension loads, and the firewall allows local connections on port 9003.

This setup is documented for the optional debugger workflow. It was not required to run Xdebug for this assignment.

#### `session_regenerate_id()` user enhancement

The page 6 security notes ask for the future session-security pattern to be recorded.

> [!NOTE] 🤖 Copilot Says:
> `session_regenerate_id()` creates a new session identifier while keeping the current session data. Use it after a successful login to reduce session fixation risk. The current SSP05 pages do not use sessions or login, so this function is documented for future authenticated pages rather than added to these forms.

User enhancement: I added this security note after reviewing page 6. This corrects the earlier Week 3 notes, which said that session security was out of scope but did not name `session_regenerate_id()`.

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

## Week 4

> [!NOTE] **NOTE TO THE INSTRUCTOR:**
> The Week 4 starter code uses a few constructs that I avoided in earlier weeks: the `<?= ?>` short echo tag, `??` and `??=`, `class="error"` in Ex 15-1, and `login.php` as the login page name. I kept the first three because the Week 4 assignment prescribes them and PHP 8 is the target. I used `index.php` as the login page in `SSP06_21_2` so it matches the other exercise folders, and every redirect points to it. Please advise if you want `login.php`.

### ✅ Accepted

- Ex 15-1: I accepted `htmlspecialchars()` on `$exception->getMessage()` before it prints. Exception text can include submitted values, so it needs the same escaping as any other output.
- Ex 21-2: I accepted `session_unset()` and `session_destroy()` followed by a redirect in `logout.php`. I also clear the remember-me cookie there so a logged-out browser does not keep the username.
- Ex 11-1: I accepted `array_map()` with an arrow function, `fn(string $fruit): string => strtoupper($fruit)`, for the uppercase list. It is short, it needs no `use` clause, and I checked that it leaves the original `$fruits` array unchanged.
- Ex 15-1: I accepted `filter_var($website, FILTER_VALIDATE_URL)` for the website field. It handles URL edge cases that a pattern I wrote would miss, and it fails the same way the email check does, so the error list stays consistent.
- Ex 15-1: I accepted `preg_match()` for the phone and ZIP formats, `/^\d{3}-\d{3}-\d{4}$/` and `/^\d{5}(-\d{4})?$/`. `filter_var()` has no validator for either one, and both patterns are anchored so extra characters fail. I tested a valid and an invalid value for each.
- Ex 21-2: I accepted the guard in `auth.php` that redirects to the login page when `$_SESSION['user']` is not set. Every protected page (`dashboard.php`, `profile.php`, and the cart pages) requires that one file, so the login check lives in one place.

### ❌ Rejected

- Ex 11-1: I rejected `filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS)`. It encodes the value on input and `htmlspecialchars()` then encodes it again on output. I read the raw value with `FILTER_UNSAFE_RAW`, check that it is a string made of letters only, and escape it where it prints.
- Ex 15-1: I rejected a custom email regex. `filter_var($email, FILTER_VALIDATE_EMAIL)` follows the real email rules and a hand-written pattern would reject valid addresses or accept bad ones.
- Ex 15-1: I rejected `strip_tags()` for the message output. It removes tags but it is not XSS protection. The message goes through `nl2br(htmlspecialchars(...))`, in that order, so line breaks stay and any HTML shows as text.
- Ex 15-1: I rejected `addslashes()` for database safety. This exercise has no database, so nothing runs a query here. When an exercise does, I will use PDO prepared statements because `addslashes()` is not enough.
- Ex 21-2: I rejected `md5()` and `sha1()` for passwords. They are fast hashes that are cheap to crack. The user array uses `password_hash(..., PASSWORD_DEFAULT)`.
- Ex 21-2: I rejected comparing the typed password to a plain string such as `$pw === 'secret'`. The login uses `password_verify()` against the stored hash, so no plain-text password is compared or stored.
- Ex 23-1: I rejected a cart page that depends on `session_start()` already being there. `$_SESSION` does nothing without it and Copilot can leave it out. `auth.php` calls `session_start()` and the cart page requires `auth.php` before it touches the session.

### ✏️ Improved

- Ex 11-1: The final code uses `[]` short array syntax and not `array()`.
- Ex 11-1: `in_array($search, $fruits, true)` has the strict third argument, so `'1'` does not match a number by type juggling.
- Ex 11-1: The six-character filter is `array_filter()` with an arrow function, `fn(string $fruit): bool => strlen($fruit) >= 6`, and not an anonymous `function` block.
- Ex 11-1: I wrapped every printed value in `htmlspecialchars()`, including the item count and the `id` column that the starter printed with a bare `(int)` cast, and I put `number_format()` on the price. I also replaced the double-quoted message with single quotes and concatenation to match my other pages.
- Ex 15-1: The first version threw `FormatException` the moment the product code failed, which hid every other error. I changed `validateContact()` to collect all errors first and then throw `FormatException` if the product code was one of them, otherwise `ValidationException`. The catch order stays most specific first.
- Ex 21-2: I added `session_regenerate_id(true)` after a successful `password_verify()` so an old session id cannot be reused after login.
- Ex 21-2: I read the form values with `filter_input(INPUT_POST, ...)` and not `$_POST` directly, and checked each with `is_string()`.
- Ex 21-2: The lockout counts failed attempts for each username in `$_SESSION['attempts']`, and not one counter for the whole session. After three failures that account is refused, and a failed guess at one name does not lock another.
- Ex 23-1: I shortened the cart setup to `$_SESSION['cart'] ??= [];`, since PHP 8 has the assignment form.
- Ex 23-1: I read the product id with `filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT)` and check for both `false` and `null`, and not a direct `(int) $_POST[...]` cast.
- Ex 23-1: I printed every price and subtotal through `number_format(..., 2)` inside `htmlspecialchars()`, and I escaped the item count and the hidden `product_id` values.
- Ex 23-1: I added `require_once __DIR__ . '/../SSP06_21_2/auth.php'` so the cart needs a login and the path does not depend on Apache's working folder. I used the same `require_once __DIR__` form in the dashboard and profile pages.
- Ex 21-2: The dashboard shows the login time in `America/Chicago`, since Apollo runs UTC.

## Week 5

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

## Week 6

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

## Week 7

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

## Week 8

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text
