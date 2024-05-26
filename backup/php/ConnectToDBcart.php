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
		$sql = "SELECT * FROM products ORDER by id ASC;";
		
        //QUERY DB
		$result = mysqli_query($connection,$sql);

		if($result){
			if(mysqli_num_rows($result)>0){
				while($product = mysqli_fetch_assoc($result)){
					print_r($product);
				}
			}
		}
    
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