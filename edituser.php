<?php
// Start session
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['username'])) {
    if ($_SESSION['type'] == 1) {
        include("header_user.php");
    } else {
        include("header_admin.php");
    }
}

class Users
{
    public $username;
    public $password;
    public $type;
    public $message;

    function addUser()
    {
        include("connection.php");//connect with database

        // Check if username already exists
        $check_sql = "SELECT * FROM users WHERE username = ?";
        $check_stmt = mysqli_prepare($cinema, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $this->username);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $this->message = 'Username already exists. Please choose a different username.';
            mysqli_close($cinema);
            return;
        }

        // Insert new user
        $insert_sql = "INSERT INTO users (username, password, type) VALUES (?, ?, ?)";
        $insert_stmt = mysqli_prepare($cinema, $insert_sql);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($insert_stmt, "sss", $this->username, $hashedPassword, $this->type);

        if (mysqli_stmt_execute($insert_stmt)) {
            mysqli_close($cinema);
            $this->message = 'User added successfully!';
        } else {
            mysqli_close($cinema);
            $this->message = 'Error: Unable to add user. Please try again.';
        }
    }

    function deleteUser()
    {
       include("connection.php");//connect with database

        // Delete user
        $delete_sql = "DELETE FROM users WHERE username = ?";
        $delete_stmt = mysqli_prepare($cinema, $delete_sql);
        mysqli_stmt_bind_param($delete_stmt, "s", $this->username);
        mysqli_stmt_execute($delete_stmt);

        $affected_rows = mysqli_stmt_affected_rows($delete_stmt);

        mysqli_close($cinema); // Close the connection after executing the query

        if ($affected_rows > 0) {
            $this->message = 'User deleted successfully!';
        } else {
            $this->message = 'Error: User not found. Please enter a valid username.';
        }
    }
}

// Handle adding new user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addUser"])) {
    $user = new Users();
    $user->username = $_POST["username"];
    $user->password = $_POST["password"];
    $user->type = $_POST["type"];

    // Check for blank options
    if (empty($user->username) || empty($user->password) || (!isset($user->type) && $user->type !== "0")) {
        $user->message = 'Please fill in all fields.';
    } else {
        $user->addUser();
        // Clear form fields
        $_POST["username"] = $_POST["password"] = $_POST["type"] = "";
    }
}

// Handle deleting user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteUser"])) {
    $deleteUser = new Users();
    $deleteUser->username = $_POST["delete_username"];

    // Check for blank options
    if (empty($deleteUser->username)) {
        $deleteUser->message = 'Please enter a username to delete.';
    } else {
        $deleteUser->deleteUser();
        // Clear form fields
        $_POST["delete_username"] = "";
    }
}

// Fetch users from the database
include("connection.php");//connect with database

$sql = "SELECT * FROM users";
$result = mysqli_query($cinema, $sql);

if (!$result) {
    die("Error retrieving users: " . mysqli_error($cinema));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="container my-5">
        <!-- Display messages at the top -->
        <?php if (!empty($user->message) || !empty($deleteUser->message)) : ?>
            <div class="alert <?php echo (empty($user->message) ? 'alert-danger' : 'alert-success'); ?>" role="alert">
                <?php echo (empty($user->message) ? $deleteUser->message : $user->message); ?>
            </div>
        <?php endif; ?>

        <h2 class="text-center">Add new User</h2>

        <!-- User Add Form -->
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="type">User Type(1: for user or 0: for admin)</label>
                <input type="number" class="form-control" id="type" placeholder="Enter user type" name="type" value="<?php echo isset($_POST['type']) ? $_POST['type'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="addUser">Add User</button>
        </form>

        <!-- User Delete Form -->
        <h2 class="text-center mt-4">Delete User</h2>
        <form method="post">
            <div class="form-group">
                <label for="delete_username">Username to Delete</label>
                <input type="text" class="form-control" id="delete_username" placeholder="Enter username to delete" name="delete_username" value="<?php echo isset($_POST['delete_username']) ? $_POST['delete_username'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block" name="deleteUser">Delete User</button>
        </form>

        <!-- Display users in a table with white text -->
          <!-- Display users in a table with white text -->
        <h2 class="text-center mt-4">User List</h2>
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>User Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>


<?php include 'footer.php'; ?>