<?php
class show{
	public $start;
	public $ending;
	public $movie_title;	
	public $movie_image;
	public $allshows;
	public $movie_id;
	public $movie_director;
        public $movie_plot;
	
	function getshows2()
	{
		$servername = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "cinema";

// Create connection
		$cinema = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
// Check connection
		if (!$cinema)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql ="SELECT shows.showid  ,shows.end,shows.start , movies.movie_title, movies.movie_image,movies.movie_director,movies.movie_plot , movies.movie_id as aaa FROM shows INNER JOIN movies ON movies.movie_id = shows.movie_id  having aaa = $this->movie_id";
		$result = mysqli_query($cinema, $sql);

		if (mysqli_num_rows($result) > 0) {
  // output data of each row
		$i=0;
		while($row = mysqli_fetch_assoc($result)) {
			//var_dump($row);
			$this->allshows[$i]['showid']= $row["showid"];
			$this->allshows[$i]['start']= $row["start"];
			$this->allshows[$i]['end']= $row["end"];
			$this->allshows[$i]['movie_title']= $row["movie_title"];
			$this->allshows[$i]['movie_image']= $row["movie_image"];
                        $this->allshows[$i]['movie_director']= $row["movie_director"];
                        $this->allshows[$i]['movie_plot']= $row["movie_plot"];
			$i++;
		 }
		} else 	
		{
			echo "0 results";
		}
		mysqli_close($cinema);
}
	
	
	function getshows()
	{
		$servername = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "cinema";

// Create connection
		$cinema = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
// Check connection
		if (!$cinema)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT shows.showid,shows.end,shows.start , movies.movie_title, movies.movie_image  FROM shows INNER JOIN movies ON movies.movie_id = shows.movie_id";
		//echo $sql;
		$result = mysqli_query($cinema, $sql);

		if (mysqli_num_rows($result) > 0) {
  // output data of each row
		$i=0;
		while($row = mysqli_fetch_assoc($result)) {
			//var_dump($row);
			$this->allshows[$i]['showid']= $row["showid"];
			$this->allshows[$i]['start']= $row["start"];
			$this->allshows[$i]['end']= $row["end"];
			$this->allshows[$i]['movie_title']= $row["movie_title"];
			$this->allshows[$i]['movie_image']= $row["movie_image"];
			$i++;
		 }
		} else 	
		{
			echo "0 results";
		}
		mysqli_close($cinema);
}


	
	
	function edit()
	{
		$servername = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$dbname = "cinema";

// Create connection
		$cinema = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
// Check connection
		if (!$cinema)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "delete from settings";
		
		mysqli_query($cinema, $sql); 
		$sql = "INSERT INTO shows (start,end,film) VALUES ('".$this->start."', '".$this->ending."', '".$this->film."')";
		echo $sql;
		if (mysqli_query($cinema, $sql)) 
		{
			mysqli_close($cinema);

			header("Location:menu.php");
        }
		else 
		{
			mysqli_close($cinema);
			echo "Error: " . $sql . "<br>" . mysqli_error($cinema);
		}
	}
	
	
	
}

?>