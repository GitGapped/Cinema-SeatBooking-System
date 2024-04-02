<?php
session_start();
if(!isset($_SESSION["username"]))
{
	 header("Location:login.php");
}
$username = $_SESSION["username"];
 $type = $_SESSION["type"];
if($type == 1)
{
	include ("header_user.php");
}
else
{
	include ("header_admin.php");
}
?>
<?php

include "classbooking.php";

// Check if the form is submitted
if(isset($_GET["submit"])) { 
    $book1 = new booking();
    $book1->username = $_SESSION['username'];
    $book1->bookdate = $_SESSION["bookdate"];
    $book1->showid = $_SESSION["bookshow"];
    
    // Array to store booked seats
    $bookedSeats = array();

    for($i=0; $i < $_SESSION['seatsr']; $i++) {
        for($j=0; $j < $_SESSION['seatsc']; $j++) {
            $a = $i.'_'.$j;
            if(isset($_GET[$a])) {
                $b = explode("_", $a);
                $book1->seatr = $b[0];
                $book1->seatc = $b[1];
                if(!$book1->make_booking()) {
                    // If the seat is not available, you can handle it here
                    echo "Seat not available!";
                } else {
                    // Add booked seat to the array
                    $bookedSeats[] = $a;
                }
            }
        }
    }

echo '<script>
            setTimeout(function(){
                window.location.href = "movie_details.php";
            }, 3000);
          </script>';
}
?>

<!-- Rest of your HTML code remains unchanged -->

<?php





$book1 = new booking();
	
$book1->bookdate=$_SESSION["bookdate"];
$book1->showid=$_SESSION["bookshow"];

$book1->getavailabelseats();
$sr=$_SESSION['seatsr'];
$sc=$_SESSION['seatsc'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_SESSION["cinemaname"]?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
        padding-top: 10%;
      display: grid;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .visible-container {
        padding-top: 10%;
      border: 1px solid #ddd;
      padding: 20px;
      width: 100%;
      text-align: center;
    }

    .notification {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="visible-container">
    <form>
      <div class="container-mt3">
        <h2>Booking Form</h2>
        <?php for($i=0; $i < $sr; $i++)
          include ("row.php");
        ?>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <!-- Notification area -->
    <div class="notification">
      <?php
        // Display a thank you message with booked seats
        if (!empty($bookedSeats)) {
          echo '<div class="alert alert-success" role="alert">';
           echo $_SESSION['username']; 
           echo'<br>';
          echo "Thanks for booking seats: " . implode(', ', $bookedSeats);
          echo'<br>';
          echo' You will now be redirected!';
          echo '</div>';
        }
      ?>
    </div>
  </div>
</body>
<?php include 'footer.php'; ?>
</html>

<style> 
    @media (max-width: 768px){
        .body{
             padding-top: 100%;
              display: grid;
        align-items: center;
        justify-content: center;
         height: 100vh;
        margin: 0;
        }
    }
     @media (max-width: 600px){
        .body{
             padding-top: 40%;
              border: 1px solid #ddd;
      padding: 20px;
      width: 100%;
      text-align: center;
        }
    }
   
        
    </style>
    