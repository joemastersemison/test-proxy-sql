<?php

   include('credentials.inc');

   // Create connection
   $conn = new mysqli('127.0.0.1', $username, $password, $dbname, 6033);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }


   function get_single_value($conn, $sql) {
     $result = $conn->query($sql);
     if ($result->num_rows > 0 && $row = mysqli_fetch_array($result)) {
       return $row[0];
     } else {
       return '';
     }
   }

?>

<!doctype html>
<html lang="en">

<head>
    <title>Direct-to-Maste Exampler</title>
</head>

<body>
    <h1>Direct-to-Master Test</h1>
    <ul>
        <li>Employee Count: <?php echo get_single_value($conn, "select count(*) from employees"); ?></li>
        <li>Female Employee Count: <?php echo get_single_value($conn, "select count(*) from employees WHERE gender='F'"); ?></li>
    </ul>

</body>

  <?php
  $conn->close();
?>
