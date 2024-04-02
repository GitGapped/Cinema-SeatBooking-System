


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Page Title</title>
    <!-- Bootstrap CSS with dark theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-brand:hover {
            transform: scale(1.2);
            transition: transform 0.3s ease-in-out;
        }
       
    </style>
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Your Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="editsettings.php">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkseats.php">Check Seats</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="editshows.php">Edit Shows</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edituser.php">Edit users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" >Welcome <?php echo $_SESSION['username']; ?>!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Rest of your content -->

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
