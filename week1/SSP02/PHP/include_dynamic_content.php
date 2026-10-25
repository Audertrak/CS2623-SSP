<?php
/*
 * include_dynamic_content.php - CS2623 SSP02
 * Builds the weekly planner table with a loop.
 */
?>
<!-- The weekly planner table. -->
<table id="weekly-planner">
  <caption>CS2623 Weekly Planner - Cunkle</caption>
  <thead>
    <tr>
      <th scope="col">Day of Week</th>
      <th scope="col">Task</th>
      <th scope="col">Time (hrs.)</th>
    </tr>
  </thead>
  <tbody>
<?php
// The loop counts from one to seven. Each pass prints one table row.
for ($counter = 1; $counter < 8; $counter++) {
    // Show half the counter with one decimal place.
    $hours = number_format($counter / 2, 1);

    echo '    <tr>';
    echo '      <td>' . htmlspecialchars((string) $counter, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '      <td>Study for CS2623</td>';
    echo '      <td>' . htmlspecialchars($hours, ENT_QUOTES, 'UTF-8') . '</td>';
    echo "</tr>\n";
}
?>
  </tbody>
</table>
