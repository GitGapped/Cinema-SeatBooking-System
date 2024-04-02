<?php
session_start(); 
if(!isset($_SESSION["username"]))
{
	 header("Location:login.php");
}
if(isset($_GET["bookdate"])  && isset($_GET["bookshow"]) )
{ 
 
	$_SESSION["bookdate"]=$_GET["bookdate"];
	$_SESSION["bookshow"]=$_GET["bookshow"];
	header("Location:bookingseat.php");
	
	
	//$book1->make_booking();
}




if(isset($_SESSION['username']))
{
    if($_SESSION['type'] == 1)
    {
        include("header_user.php");
    }   
   
            
}
 else
    {  
        include("header_admin.php");
    }
?>

<?php
include "classbooking.php";

//include "functions.php";

?>

<?php

if(isset($_GET["bookdate"])  && isset($_GET["bookshow"]) )
{ 
 echo "OK";
	$_SESSION["bookdate"]=$_GET["bookdate"];
	$_SESSION["bookshow"]=$_GET["bookshow"];
	header("Location:bookingseat.php");
	
	
	
}

?>


<?php 
	include("show.php");
   $usershow = new show();
   $usershow->movie_id = $_GET['movie_id'];
   $usershow->getshows2();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>/*setting style*/
    body {
      background-color: #f8f9fa; /* Set  background color */
    }

    .custom-card-body {
        
      background-color: #f8f9fa; 
    }
    .custom-row {
      background-color: #f8f9fa; /* Set the same color as the body background */
      padding: 20px; /* Optional: Add padding to the row for better spacing */
    }
    .card{
        margin-top: 10vh;
        margin-bottom: 5vh;
    }
    /* Add custom styles if needed */
  </style>
</head>

<body>
  <?php
  $sh = $usershow->allshows[0];
  ?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header text-center">
            <h3 style="color: #444; font-size: 23px;"><?php echo $sh['movie_title']; ?></h3>
          </div>
          <div class="card-body custom-card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="<?php echo "img/".$sh['movie_image']; ?>" class="img-fluid" alt="">
              </div>
              <div class="col-md-6">
                <p class="p-link" style="font-size: 15px;"><b>Director : </b><?php echo $sh['movie_director']; ?></p>
                <p class="p-link" style="font-size: 15px;"><b>Plot : </b><?php echo $sh['movie_plot']; ?></p>
                

                <h2>Booking form</h2>
                <form>
                  <div class="mb-3 mt-3">
                    <label for="bookdate">Book Date:</label>
                    
                  <input type="date" class="form-control" id="bookdate" placeholder="Enter booking date" name="bookdate"  min= <?php echo date('Y-m-d');?> max = <?php echo $_SESSION['datelimit'];?>>
                  </div>
                  <div class="mb-3 mt-3">
                    <label for="bookshow">Book show:</label>
                    <select id="bookshow" name="bookshow" class="form-control">
                      <?php
                      foreach($usershow->allshows as $sh) {
                        echo "<option value='".$sh['showid']."'> ".$sh['start']."".'-'."".$sh['end']." ".$sh['movie_title']."</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php include 'footer.php'; ?>