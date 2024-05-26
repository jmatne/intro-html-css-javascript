<!DOCTYPE html>
<html>
<head>
	<title>Basic Database Connection in PHP</title>
</head>

<body>
    <h1>Testing DB</h1>
	<?php
	
		//Step 1:  Create a database connection
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpassword = "";
		$dbname = "cart";

		$connection = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
		
		//Test if connection occoured
		if(mysqli_connect_errno()){
			die("DB connection failed: " .
				mysqli_connect_error() .
					" (" . mysqli_connect_errno() . ")"
					);
		}

		if (!$connection)
			{
				die('Could not connect: ' . mysqli_error());
			}
		
        
        //ASSIGNED QUERY TO VARIABLE
		$sql = "SELECT * FROM products WHERE id='1';";
		
        //QUERY DB
		$result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($result);
		
        //OPTIONAL: OUTPUT THE INFO TO THE PAGE OR CAN STORE USING JS AS BELOW in line 56
        echo "Value received from DB : " . $row['name'];
    
        echo "<br>Value received from DB : " . $row['description'];
      
        echo " <br>Value received from DB : " . $row['price'];
    
        //close db connection
        mysqli_close($connection);
        
	?>
    <h2>After PHP</h2>

</body>
</html>

<script>
    //create a variable called jsvar.
    //the variable is then made equals to value in 'name' column
    var jsvar = "<?php echo $row['name'] ?>";
        alert(jsvar);
    var jsvar2 = "<?php echo $row['price'] ?>";
        alert(jsvar2);
</script>