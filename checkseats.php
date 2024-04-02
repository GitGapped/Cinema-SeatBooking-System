<?php
session_start(); 
if(!isset($_SESSION["username"]))
{
    header("Location:login.php");
}
if(isset($_SESSION['username']))
{
    if($_SESSION['type'] == 1)
    {
        include("header_user.php");
    }   
    else
    {
        include("header_admin.php");    
    }
}
    
include "classbooking.php";

if(isset($_GET["submit"]))
{ 
    
    $book1 = new booking();
    
    foreach($_GET as $k=>$v)
    {
        if($k != 'submit')
        {
            $book1->check_book($k);
        }
    }
    header("menu.php");
}

$book1 = new booking();
$book1->getuncheckedseats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Check Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS with dark theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set a light background color */
            font-family: Arial, sans-serif;
        }

        .navbar {
            margin-bottom: 10vh; /* Add some space below the navbar */
        }

        .container {
            max-width: 100%; /* Adjust the maximum width of the container */
            margin: auto;
        }

        .mt-3 {
            margin-bottom: 20vh;
        }

        h2 {
            text-align: center;
        }

        /* Center the form container */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20vh; /* Adjust the height as needed */
           
            padding: 20px; /* Add padding for better visibility */
            border: 1px solid #000; /* Add a border */
            border-radius: 5px; /* Optional: Add border radius */
        }

        /* Style the checkboxes */
        .form-check-label {
            color: white;
        }
    </style>
</head>
<body>

<!-- Center the form container -->
<div class="container form-container">
    <form>
        <div class="container-mt3">
            <h2>Check Form</h2>
            <?php 
                $i=0;
                foreach($book1->cseat as $rec)
                {
                    ?>
            <br>
                <div class="row">
                    <label class="form-check-label" for="<?php echo $i?>">
                        <input type="checkbox" class="form-check-input" id="<?php echo $i?>" name="<?php echo $book1->cseat[$i]['id']?>" value="<?php echo $book1->cseat[$i]['id']?>">
                        
                        <!-- Making the specified fields appear in blue, bold, and larger font -->
                        <a><?php echo ($i+1)?></a>
                        <span style="color: white;"><?php echo $book1->cseat[$i]['username']?></span> 
                        wants to book a show on: 
                        <strong style="color: white;"><?php echo $book1->cseat[$i]['bookdate']?></strong> 
                        for the show: 
                        <strong style="color: white;"><?php echo $book1->cseat[$i]['showid']?></strong> 
                        seat: 
                        <strong style="color: white;"><?php echo $book1->cseat[$i]['seatr']?></strong> _ 
                        <strong style="color: white;"><?php echo $book1->cseat[$i]['seatc']?></strong>
                    </label>
                </div>
            <?php
                $i++;
                }
            ?>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php include 'footer.php'; ?>


<style> 
    @media (min-width: 768px){
        .container {
            max-width: 50%; /* Adjust the maximum width of the container */
            margin: auto;
            
        }
    }
    @media (max-width: 768px){
        .form-container{
            max-width: 70%; /* Adjust the maximum width of the container */
            margin: auto;
            
        }
    }
        @media (max-width: 816px){
        .form-container{
            max-width: 80%; /* Adjust the maximum width of the container */
            margin: auto;
            
          
        }
         @media (min-width: 502px){
        .form-container{
            max-width: 100%; /* Adjust the maximum width of the container */
            margin: auto;
            
          
        }
    }
    </style>