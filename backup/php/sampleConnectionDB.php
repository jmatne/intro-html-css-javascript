<!DOCTYPE html>

<!-- This webpage was created by Juan Matne student email G00411388@gmit.ie Feb 3 2022  --> 

<html>

<head>
			<title>Basic database connection in PHP  </title>
</head>

<body>


    <?php  
        // Step 1: Create a database connection
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $dbname = "empdept2";
        
        // Create variable connection string
        $connection = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
        
        // test if connection occoured
        if(mysqli_connect_errno()){
        	die("DB connection failed: " .
        	mysqli_connect_error() .
        		" (" . mysqli_connect_errno() . ") "
        		);	
        }
        if (!$connection)
        	{
        	die('Could not connect: ' . mysqli_error());
        	}	
        // Step 2: Perform Database Query
        
       $result = mysqli_query($connection,"SELECT * FROM emp"); 
       
       // Step 3: Use returned data
       
       // opening table
       echo "<table border='1' id='myTable'> 
       <tr>
       <th>Dept Id</th>
       <th>Dept Name</th>
       <th>Location</th>
       </tr>";
       
       while($row = mysqli_fetch_array($result))
       {
       	echo"<tr>";
       	echo"<td>" . $row['EMPNO'] . "</td>";
       	echo"<td>" . $row['ENAME'] . "</td>";
       	echo"<td>" . $row['JOB'] . "</td>";
       	echo"</tr>";
       	
       }
       
       echo "</table>"; //closing table 
       
       // Step 4: Release the returned data
       
       mysqli_free_result($result);
       
       // Step 5; Close database connection
       
       mysqli_close($connection);
    ?>
    


</body>

</html>
