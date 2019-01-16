<?php
$conn = mysqli_connect("localhost", "root", "111111", "opentutorials");

$sql = "
  SELECT title, description, created
  FROM topic
  LIMIT 1000
";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
  echo '<h2>'.$row['title'].'</h2>';
  echo $row['description'];
}

//var_dump(mysqli_fetch_array($result));

//print_r(mysqli_fetch_array($result));
?>
