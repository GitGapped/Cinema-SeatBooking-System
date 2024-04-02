<?php
session_start();
include "header.php";

if(isset($_SESSION['username']))
{
    header("Location:menu.php");
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
            $sql = "SELECT * FROM users WHERE username = '" . $_GET['username'] . "'";
            $result = $cinema->query($sql);

            if ($result->num_rows > 0) {
                $errorMessage = "Username already exists!";
            } else {
                $password = mysqli_real_escape_string($cinema, $_GET['password']);
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO users (username, password, type) VALUES ('" . $_GET['username'] . "','" . $hashedPassword . "',1)";

                if ($cinema->query($sql) === TRUE) {
                    $_SESSION['username'] = $_GET['username'];
                    $_SESSION['type'] = 1;
                    header("Location:menu.php");
                    exit();
                } else {
                    $errorMessage = "Error: " . $sql . "<br>" . $cinema->error;
                }
            }
        }
    }

    $cinema->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
    <h2>REGISTER</h2>
    <?php if (isset($errorMessage)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php } ?>

    <form action="" method="GET">
        <div class="form-group">
            <label for="username" class="text-light">Username:</label>
            <input type="text" class="form-control custom-textarea" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password" class="text-light">Password:</label>
            <input type="password" class="form-control custom-textarea" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

    <p class="mt-3">Already have an account? <a href="login.php">Login now!</a></p>
</div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php include 'footer.php'; ?>
<style>
    @media (max-width: 768px) {
        .mt-3 {
            margin-bottom: 0vh;
        }
    }
</style>
