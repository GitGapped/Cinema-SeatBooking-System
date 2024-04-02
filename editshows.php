<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

if (isset($_SESSION['username'])) {
    if ($_SESSION['type'] == 1) {
        include("header_user.php");
    } else {
        include("header_admin.php");
    }
}

class Movies
{
    public $movie_title;
    public $movie_image;
    public $movie_director;
    public $movie_plot;
    public $message;

    function addMovie()
    {
     include("connection.php");//connect with database

        // Check if movie title already exists
        $check_sql = "SELECT * FROM movies WHERE movie_title = ?";
        $check_stmt = mysqli_prepare($cinema, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $this->movie_title);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $this->message = 'Movie title already exists. Please choose a different title.';
            mysqli_close($cinema);
            return;
        }

        // Validate input for only numbers and letters
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $this->movie_title) || !preg_match("/^[a-zA-Z0-9 ]*$/", $this->movie_director) || !preg_match("/^[a-zA-Z0-9 ]*$/", $this->movie_plot)) {
            $this->message = 'Only letters and numbers are allowed for movie title, director, and plot.';
            mysqli_close($cinema);
            return;
        }

        // Insert new movie
        $insert_sql = "INSERT INTO movies (movie_title, movie_director, movie_plot, movie_image) VALUES (?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($cinema, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ssss", $this->movie_title, $this->movie_director, $this->movie_plot, $this->movie_image);

        if (mysqli_stmt_execute($insert_stmt)) {
            // Get the auto-generated movie_id
            $movie_id = mysqli_insert_id($cinema);

            // Insert into shows table
            $start_time = $_GET["start_time"];
            $end_time = $_GET["end_time"];

            $insert_show_sql = "INSERT INTO shows (start, end, movie_id) VALUES (?, ?, ?)";
            $insert_show_stmt = mysqli_prepare($cinema, $insert_show_sql);
            mysqli_stmt_bind_param($insert_show_stmt, "ssi", $start_time, $end_time, $movie_id);

            if (mysqli_stmt_execute($insert_show_stmt)) {
                mysqli_close($cinema);
                $this->message = 'Movie and show added successfully!';
            } else {
                mysqli_close($cinema);
                $this->message = 'Error: Unable to add show. Please try again.';
            }
        } else {
            mysqli_close($cinema);
            $this->message = 'Error: Unable to add movie. Please try again.';
        }
    }

    function deleteMovie()
{
    include("connection.php");//connect with database

    // Get movie_id for the given movie title
    $get_movie_id_sql = "SELECT movie_id FROM movies WHERE movie_title = ?";
    $get_movie_id_stmt = mysqli_prepare($cinema, $get_movie_id_sql);
    mysqli_stmt_bind_param($get_movie_id_stmt, "s", $this->movie_title);
    mysqli_stmt_execute($get_movie_id_stmt);
    mysqli_stmt_bind_result($get_movie_id_stmt, $movie_id);

    // Fetch movie_id
    if (mysqli_stmt_fetch($get_movie_id_stmt)) {
        // Close the first prepared statement
        mysqli_stmt_close($get_movie_id_stmt);

        // Delete from movies table
        $delete_movie_sql = "DELETE FROM movies WHERE movie_id = ?";
        $delete_movie_stmt = mysqli_prepare($cinema, $delete_movie_sql);
        mysqli_stmt_bind_param($delete_movie_stmt, "i", $movie_id);
        mysqli_stmt_execute($delete_movie_stmt);

        // Delete related shows from shows table
        $delete_shows_sql = "DELETE FROM shows WHERE movie_id = ?";
        $delete_shows_stmt = mysqli_prepare($cinema, $delete_shows_sql);
        mysqli_stmt_bind_param($delete_shows_stmt, "i", $movie_id);
        mysqli_stmt_execute($delete_shows_stmt);

        mysqli_close($cinema);
        $this->message = 'Movie and related shows deleted successfully!';
    } else {
        mysqli_close($cinema);
        $this->message = 'Error: Movie not found. Please enter a valid movie title.';
    }
}
}

if (isset($_GET["movie_title"]) && isset($_GET["movie_director"]) && isset($_GET["movie_plot"])) {
    $movie = new Movies();
    $movie->movie_title = $_GET["movie_title"];
    $movie->movie_director = $_GET["movie_director"];
    $movie->movie_plot = $_GET["movie_plot"];
    $movie->movie_image = $_GET["movie_image"];

    // Check for blank options
    if (empty($movie->movie_title) || empty($movie->movie_director) || empty($movie->movie_plot)) {
        $movie->message = 'Please fill in all fields.';
    } else {
        $movie->addMovie();
    }
}

if (isset($_GET["delete_title"])) {
    $deleteMovie = new Movies();
    $deleteMovie->movie_title = $_GET["delete_title"];

    // Check for blank options
    if (empty($deleteMovie->movie_title)) {
        $deleteMovie->message = 'Please enter a movie title to delete.';
    } else {
        $deleteMovie->deleteMovie();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shows Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="container my-5">
        <h2 class="text-center">Shows Form</h2>

        <!-- Movie Add Form -->
        <form method="get">
            <div class="form-group">
                <label for="movie_title">Movie Title</label>
                <input type="text" class="form-control" id="movie_title" placeholder="Enter movie title" name="movie_title" required>
            </div>
            <div class="form-group">
                <label for="movie_director">Movie Director</label>
                <input type="text" class="form-control" id="movie_director" placeholder="Enter movie director" name="movie_director" required>
            </div>
            <div class="form-group">
                <label for="movie_plot">Movie Plot</label>
                <input type="text" class="form-control" id="movie_plot" placeholder="Enter movie plot" name="movie_plot" required>
            </div>
            <div class="form-group">
                <label for="movie_image">Movie Image (Link)</label>
                <input type="text" class="form-control" id="movie_image" placeholder="Enter movie image link" name="movie_image" required>
            </div>
            <div class="form-group">
                <label for="start_time">Starting Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="form-group">
                <label for="end_time">Ending Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>

        <!-- Movie Delete Form -->
        <h2 class="text-center mt-4">Delete Movie</h2>
        <form method="get">
            <div class="form-group">
                <label for="delete_title">Movie Title to Delete</label>
                <input type="text" class="form-control" id="delete_title" placeholder="Enter movie title to delete" name="delete_title" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block">Delete</button>
        </form>

        <!-- Display messages -->
        <?php if (!empty($movie->message) || !empty($deleteMovie->message)) : ?>
            <div class="mt-4 alert <?php echo (empty($movie->message) ? 'alert-danger' : 'alert-success'); ?>" role="alert">
                <?php echo (empty($movie->message) ? $deleteMovie->message : $movie->message); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php include 'footer.php'; ?>