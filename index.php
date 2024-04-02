<?php
session_start();

include("connection.php");
$sql = "SELECT * FROM settings";
$result = $cinema->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $_SESSION['cinemaname'] = $row["cinemaname"];
      $_SESSION['seatsr'] = $row["seatsr"];    
      $_SESSION['seatsc'] = $row["seatsc"];
      $_SESSION['datelimit'] = $row["datelimit"];
      
      }
} else {
  echo "0 results";
}


$sql = "SELECT * FROM shows";
$result = $cinema->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $_SESSION['showid'] = $row["showid"];
      $_SESSION['start'] = $row["start"];    
      $_SESSION['end'] = $row["end"];
      $_SESSION['movie_id'] = $row["movie_id"];
    //  $_SESSION['img'] = $row["img"];
      
      //echo $row['showid'];
      }
} else {
  echo "0 results";
}    
$cinema->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php

if(isset($_SESSION['username']))
{
    if($_SESSION['type'] == 1)
    {header("Location: movie_details.php");
        include("header_user.php");
        
        
    }   
    else
    {
        include("header_admin.php")  ;    
    }
            
}
else {
   header("Location: login.php");
}
?>


