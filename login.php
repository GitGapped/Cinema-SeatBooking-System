<?php
session_start();
include "header.php";

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
 

if (isset($_GET['username'])) {
    include("connection.php");//connect with database

    // Check for special characters in the username using a regular expression
    if (!preg_match('/^[a-zA-Z0-9]+$/', $_GET['username'])) {
        $errorMessage = "Invalid characters in the username. Use only letters and numbers.";
    } else {
        // Check for special characters in the password using a regular expression
        if (!preg_match('/^[a-zA-Z0-9]+$/', $_GET['password'])) {
            $errorMessage = "Invalid characters in the password. Use only letters and numbers.";
        } else {
            // Using prepared statements to prevent SQL injection
            $stmt = $cinema->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $_GET['username']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];

                // Check if the input password matches the hashed password
                if (password_verify($_GET['password'], $hashedPassword)) {
                    $_SESSION['username'] = $_GET['username'];
                    $_SESSION['type'] = $row['type'];
                    header("Location: menu.php");
                    exit();
                } else {
                    // Check if the input password matches the plaintext password
                    $stmt = $cinema->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                    $stmt->bind_param("ss", $_GET['username'], $_GET['password']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $_SESSION['username'] = $_GET['username'];
                        $_SESSION['type'] = $row['type'];
                        header("Location: menu.php");
                        exit();
                    } else {
                        $errorMessage = "Invalid password!";
                    }
                }
            } else {
                $errorMessage = "Username not found!";
            }

            $stmt->close();
        }
    }

    $cinema->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
       /* Add more space between the navbar and the login form */
      
    }
    .mt-3{
        margin-bottom: 20vh;
    }
    h2 {
      text-align: center;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Your Brand</a>
        <!-- Add your navigation links if needed -->
    </div>
</nav>

<div class="container mt-3">
  <h2>Login</h2>
  <form method="get" action="">
    <div class="mb-3 mt-3">
      <label for="username" class="form-label">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
  </form>

  <?php if(isset($errorMessage)) { ?>
    <div class="alert alert-danger mt-3" role="alert">
      <?php echo $errorMessage; ?>
    </div>
  <?php } ?>

  <p class="mt-3">Don't have an account? <a href="registration.php">Register now!</a></p>
</div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php include 'footer.php'; ?>
<style> 
    @media (max-width: 768px){
        .mt-3{
             margin-bottom: 0vh;
        }
    }
</style>