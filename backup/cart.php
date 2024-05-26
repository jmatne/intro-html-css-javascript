<?php
session_start();
$product_ids = array();
//session_destroy();

//check if add to cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart') == 'add'){
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

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping card until it matches with GET id variable 
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove products from the shopping cart when it matches with the GET ID
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);

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
    <link rel="stylesheet" href="style.css">
    <title>Cart</title>
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

<hr class="my-4">
        <form metodh="post 
        "action="index.php?action=add&id=<?php echo $product['id']; ?>">
        <div class=""products>

    <div class="row mb-4 d-flex justify-content-between align-items-center">
      <div class="col-md-2 col-lg-2 col-xl-2">
        <img
        src="<?php echo $product['image']; ?>"
          class="img-fluid rounded-3" alt="<?php echo $product['name']; ?>">
      </div>
      <div class="col-md-3 col-lg-3 col-xl-3">
        <h6 class="text-black mb-0"><?php echo $product['name']; ?></h6>
        <h6 class="text-muted"><?php echo $product['description']; ?></h6>
      </div>
      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
        <!-- <button class="btn btn-link px-2"
          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
          <i class="fas fa-minus"></i>
        </button> -->

        <!--<input id="quantity" min="0" name="quantity" value="1" type="text"
          class="form-control form-control-sm" /> -->
        <input type="text" name="quantity" clas="form-control" value=1 />            
        <input type ="hidden" name="name" value="<?php echo $product['name']; ?>"/>
        <input type ="hidden" name="price" value="<?php echo $product['price']; ?>"/>
        <input type="submit" name="add_to_cart" class="btn btn-info" value="Add To Cart"/>

        <!-- <button class="btn btn-link px-2"
          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
          <i class="fas fa-plus"></i>
        </button> -->
      </div>
      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
        <h6 class="mb-0">€ <?php echo $product['price']; ?></h6>
      </div>
      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
          <button type="button" class="btn btn-outline-dark">X</button>
        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
      </div>
    </div>

    </div>
    </form>
                
                <?php
				endwhile;
			endif;
		endif;
        
    
        //close db connection
        mysqli_close($connection);
        
	?>
    <div style="clear:both"></div>
        <br/>
        <div class="table-responsive">
        <table class="table">
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>
            <tr>
                <th width="40%"> Product Name </th>
                <th width="10%"> Quantity </th>
                <th width="20%"> Price </th>
                <th width="15%"> Total </th>
                <th width="5%"> Action </th>
            </tr>
            <?php
                if(!empty($_SESSION['shopping_cart'])):

                    $total = 0;

                foreach($_SESSION['shopping_cart'] as $key => $product):
            ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td>$ <?php echo $product['price']; ?></td>
                    <td>$ <?php echo number_format($product['quantity']* $product['price'], 2); ?></td>
                    <td>
                        <a href="cart.php?action=delete&id=<?php echo $product['id']; ?>">
                            <div class="btn-danger">Remove</div>
                        </a>

                    </td>

                </tr>

            <?php 
                    $total = $total + ($product['quantity'] * $product['price']);
                endforeach;
                ?>

                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <!-- show checkout button only if the shopping cart is not empty -->
                    <td colspan="5">
                        <?php
                        if (ifset($_SESSION['shopping_cart'])):
                        if (count($_SESSION['shopping_cart']) > 0):
                        ?>
                        <a href="#" class="button">Checkout</a>
                    
                    <?php endif;endif; ?>
                    </td>
                </tr>
                <?php
                endif;
                ?>
                </table>
            </div>


</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
       
</body>
</html>