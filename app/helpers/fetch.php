<?php
//fetch.php
include("helper_pages.php");

require_once("dbconnect.php");

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "
  SELECT * FROM institution 
  WHERE name LIKE '%" . $search . "%'
  OR country LIKE '%" . $search . "%' LIMIT 5
 ";
} else {
    $query = "
  SELECT * FROM name ORDER BY institution_id
 ";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
   <tr>
    <td>' . $row["name"] . '</td>
    <td>' . $row["country"] . '</td>
    <td>' . $row["world_rank"] . '</td>
    <td>' . $row["national_rank"] . '</td>
    <td>' . $row["num_students"] . '</td>
   </tr>
  ';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}