<?php
session_start();
$product_ids = array();
//session_destroy();

//check if add to cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        //keep track of how many products are in the cart
        $count = count($_SESSION['shopping_cart']);

        //create sequential array for matching array keys and products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
            
            $_SESSION['shopping_cart'][$count] = array
            (
                 'id' => filter_input(INPUT_GET, 'id'),
                 'name' => filter_input(INPUT_POST, 'name'), 
                 'price' => filter_input(INPUT_POST, 'price'), 
                 'quantity' => filter_input(INPUT_POST, 'quantity') 
            );
        }
        else{//product already exists, increace quantity
            //match array key to the id of the product being added to the cart
            for($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity']+= filter_input(INPUT_POST, 'quantity');
                }
            }
        }

    }
    else { //if shopping cart does not exist, create first prodict with array key 0
        // create array using subbimited form data, start from key 0 and fill with values
        $_SESSION['shopping_cart'][0] = array
        (
             'id' => filter_input(INPUT_GET, 'id'),
             'name' => filter_input(INPUT_POST, 'name'), 
             'price' => filter_input(INPUT_POST, 'price'), 
             'quantity' => filter_input(INPUT_POST, 'quantity') 
        );
    }
}
pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo'</pre>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>test</title>
</head>
<body>
    
<div class="container">
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

		if($result):
			if(mysqli_num_rows($result)>0):
				while($product = mysqli_fetch_assoc($result)):
				?>
                    <div class="col-sm-4 col-md-3">
                        <form metodh="post "action="index.php?action=add&id=<?php echo $product['id']; ?>">
                        <div class="products">
                        <img 
                        src="<?php echo $product['image']; ?>"class="img-fluid rounded-3" alt="<?php echo $product['name']; ?>">
                        <h6 class="text-black mb-0"><?php echo $product['name']; ?></h6>
                        <h6 class="text-muted"><?php echo $product['description']; ?></h6>
                        <h6 class="mb-0">€ <?php echo $product['price']; ?></h6>
                        <input type="text" name="quantity" class ="form-control" value=1 />
                        <input type="hidden" name="name" value="<?php echo $product['name']; ?>"/>
                        <input type="hidden" name="price" value="<?php echo $product['price']; ?>"/>
                        <input type="submit" name="add_to_cart" class="bnt-info"
                               value="Add To Cart" />
                        </div>
                        
                    
                        </form>

                    </div>
                <?php
				endwhile;
			endif;
		endif;
        //close db connection
        //mysqli_close($connection);  
	?>
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
</body>
</html>