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

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

## Week 3

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

## Week 4

### ✅ Accepted

- Some text

### ❌ Rejected

- Some text

### ✏️ Improved

- Some text

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
