<?php
class booking{
	 public $username;
	 public $bookdate;
	 public $showid;
	 public $seatr;
	 public $seatc;
	 public $bookcheck;	
	 public $aseats;
	 public $cseats;
	
	function getavailabelseats()
	{
		
		for($i=0; $i< $_SESSION['seatsr']; $i++)
		{
			for($j=0; $j< $_SESSION['seatsc']; $j++)
			{
				$this->aseats[$i][$j]= 1;
			}
		}
		
		include("connection.php");//connect with database

//creat the appropriate sql query
		$sql = "SELECT seatr,seatc FROM bookings where bookdate='$this->bookdate' and showid=$this->showid";
	//echo $sql;
	//execute the sql query
	$results = mysqli_query($cinema, $sql);
	//var_dump($results);
	//var_dump($this->aseats);
	while($myseat= mysqli_fetch_assoc($results)) 
	{
		$r=$myseat["seatr"];
		$c=$myseat["seatc"];
		//echo $thesi."<br>";
		$this->aseats[$r][$c]=0;
	}
	//var_dump($this->aseats);		
		
		
		//$this->aseats=array(1,5,8);
		
	}
	
	function make_booking()
	{
	include("connection.php");

//creat the appropriate sql query
	$sql = "SELECT * FROM bookings where bookdate='$this->bookdate' and showid=$this->showid and seatr = $this->seatr and seatc=$this->seatc";
	//echo $sql;
	//execute the sql query
	$results = mysqli_query($cinema, $sql);
	//var_dump($results);
	if (mysqli_fetch_assoc($results) == NULL)
	{

		$sql = "INSERT INTO bookings (username,bookdate,showid,seatr,seatc,bookcheck) VALUES ('$this->username','$this->bookdate', $this->showid,$this->seatr,$this->seatc,0)";
		//echo $sql."<br>";
		if (mysqli_query($cinema, $sql)) 
		{
			mysqli_close($cinema);
			
        }
		else 
		{
			mysqli_close($cinema);
			echo "Error: " . $sql . "<br>" . mysqli_error($cinema);
		}
		return true;
	}
	else
	{
		return false;
		
	}
	}
	
	
	
	
	function getuncheckedseats()
	{
		
	    $this->cseat=array();
		
		include("connection.php");

//creat the appropriate sql query
		$sql = "SELECT * FROM bookings where bookcheck = 0";
	//echo $sql;
	//execute the sql query
	$results = mysqli_query($cinema, $sql);
	//var_dump($results);
	//var_dump($this->aseats);
	$i=0;
	while($myseat= mysqli_fetch_assoc($results)) 
	{
		$this->cseat[$i]['id']=$myseat["id"];
		$this->cseat[$i]['username']=$myseat["username"];
		$this->cseat[$i]['bookdate']=$myseat["bookdate"];
		$this->cseat[$i]['showid']=$myseat["showid"];	
		$this->cseat[$i]['seatr']=$myseat["seatr"];
		$this->cseat[$i]['seatc']=$myseat["seatc"];
		$i++;
	}
	//var_dump($this->cseat);		
		
		
		//$this->aseats=array(1,5,8);
		
	}
	
	function check_book($id)
	{
	include("connection.php");

//creat the appropriate sql query
	$sql = "UPDATE  bookings SET bookcheck=1 where id=$id";

	//echo $sql;
	//execute the sql query
	$cinema = mysqli_query($cinema, $sql);
	
		
			

		return true;

	}
}

?>