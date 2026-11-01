<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Cunkle, Timothy">
    <meta name="description" content="CS2623 Server-Side Programming">
    <title>CS2623 - Exercise 7-1 Personal Info</title>
  </head>

  <body>
    <header>
      <h1>CS2623 Server-Side Programming</h1>
    </header>

    <main>
      <h1>Exercise 7-1: Personal Information</h1>

      <form action="SSP05_1.php" method="post">
        <p>
          <label for="first_name">First Name:</label>
          <input type="text" id="first_name" name="first_name" required>
        </p>

        <p>
          <label for="last_name">Last Name:</label>
          <input type="text" id="last_name" name="last_name" required>
        </p>

        <p>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </p>

        <p>
          <label for="age">Age:</label>
          <input type="text" id="age" name="age" required>
        </p>

        <fieldset>
          <legend>Gender</legend>
          <label>
            <input type="radio" name="gender" value="male">
            Male
          </label>
          <label>
            <input type="radio" name="gender" value="female">
            Female
          </label>
          <label>
            <input type="radio" name="gender" value="other">
            Other
          </label>
        </fieldset>

        <p>
          <label for="country">Country:</label>
          <select id="country" name="country">
            <option value="canada">Canada</option>
            <option value="france">France</option>
            <option value="japan">Japan</option>
            <option value="mexico">Mexico</option>
            <option value="united-states">United States</option>
          </select>
        </p>

        <p>
          <label for="comments">Comments:</label>
          <textarea id="comments" name="comments" rows="5" cols="40"></textarea>
        </p>

        <button type="submit">Submit</button>
      </form>
    </main>

    <footer>
      <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>

  </body>

</html>
