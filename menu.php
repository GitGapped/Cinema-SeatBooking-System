<?php

session_start();
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
    {
        header("Location: movie_details.php");
        
    }   
    else
    {
        header("Location: editshows.php");   
    }
            
}
else {
   include("header.php")  ;
}

?>
