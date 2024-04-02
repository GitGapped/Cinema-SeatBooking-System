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

class setting
{
    public $cinemaname;
    public $datelimit;
    public $seats;
    public $seatsr;
    public $seatsc;

    function validateForm()
    {
        // Validate seats rows and seats columns
        if ($this->seatsr < 0 || $this->seatsc < 0) {
            echo '<div class="alert alert-danger" role="alert">Seats rows and seats columns cannot be negative.</div>';
            return false;
        }

        // Check if seats rows and seats columns are more than 10
        if ($this->seatsr > 10 || $this->seatsc > 10) {
            echo '<div class="alert alert-danger" role="alert">Seats rows and seats columns cannot be more than 10.</div>';
            return false;
        }

        // Other form validation checks (e.g., required fields)
        if (empty($this->cinemaname) || empty($this->datelimit) || empty($this->seatsr) || empty($this->seatsc)) {
            echo '<div class="alert alert-danger" role="alert">Please fill in all fields.</div>';
            return false;
        }

        return true;
    }

    function edit()
    {
      include("connection.php");//connect with database

        $sql = "delete from settings";
        mysqli_query($cinema, $sql);

        $sql = "INSERT INTO settings (cinemaname, datelimit, seatsr, seatsc) VALUES ('" . $this->cinemaname . "', '" . $this->datelimit . "', $this->seatsr, $this->seatsc)";

        if (mysqli_query($cinema, $sql)) {
            mysqli_close($cinema);
            header("Location: menu.php");
        } else {
            mysqli_close($cinema);
            echo "Error: " . $sql . "<br>" . mysqli_error($cinema);
        }
    }

    function read()
    {
       include("connection.php");//connect with database

        $sql = "select * from settings";
        $results = mysqli_query($cinema, $sql);
        $single_setting = mysqli_fetch_assoc($results);

        $_SESSION["cinemaname"] = $single_setting["cinemaname"];
        $_SESSION["datelimit"] = $single_setting["datelimit"];
        $_SESSION["seatsc"] = $single_setting["seatsc"];
        $_SESSION["seatsr"] = $single_setting["seatsr"];

        mysqli_close($cinema);
    }
}

?>

<div class="container mt-3">
    
    <?php
    $setting1 = new setting();
    if (isset($_GET["cinemaname"]) && isset($_GET["datelimit"])) {
        $setting1->cinemaname = $_GET["cinemaname"];
        $setting1->datelimit = $_GET["datelimit"];
        $setting1->seatsr = $_GET["seatsr"];
        $setting1->seatsc = $_GET["seatsc"];

        if ($setting1->validateForm()) {
            $setting1->edit();
            $setting1->read();
        }
    }
    ?>
    <form method="get">
        <h2>Settings form</h2>
        <div class="mb-3 mt-3">
            <label for="cinemaname">Cinema name:</label>
            <input type="text" class="form-control" id="cinemaname" placeholder="Enter cinemaname" name="cinemaname" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="datelimit">Date limit:</label>
            <input type="date" class="form-control" id="datelimit" placeholder="Enter Date limit" name="datelimit" required min=<?php echo date('Y-m-d'); ?>>
        </div>
        <div class="mb-3">
            <label for="seatsr">Seats rows:</label>
            <input type="number" class="form-control" id="seatsr" placeholder="Enter seats rows" name="seatsr" required>
        </div>
        <div class="mb-3">
            <label for="seatsc">Seats cols:</label>
            <input type="number" class="form-control" id="seatsc" placeholder="Enter seats cols" name="seatsc" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>

<style>
    h2 {
        text-align: center; 
        
    }

    form {
        max-width: 100%; /* Adjust the width as needed */
        margin-bottom: 20vh; /* Center the form horizontally */
        margin-top:9vh;
    }
    
    
</style>

<?php include 'footer.php'; ?>
