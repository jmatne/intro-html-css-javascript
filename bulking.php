<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Optional CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="bulking.js" async></script>
    <title>Template</title>

</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand">Bulking Sports Nutrition</a>

        <button 
         class="navbar-toggler"
         type="button" 
         data-bs-toggle="collapse" 
         data-bs-target="#navmenu"
         >
         <span class="navbar-toggler-icon"></span>
        </button> <!--burger menu targetting to the navmenu id below it will appear when the size goes below lg for the nav-->

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto"> <!--ms-auto align it to the left-->
                <li>
                    <nav-item>
                         <!-- Button trigger modal -->
                         <button type="button" 
                         class="btn btn-primary" 
                         data-bs-toggle="modal" 
                         data-bs-target="#exampleModal">
                            Login
                          </button>
                    </nav-item>
                </li>
                <li>
                    <nav-item>
                        <a href="#Cart" class="nav-link">Cart</a>
                    </nav-item>
                </li> 
            </ul>
        </div>
    </div>
    
</nav>


<!-- Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Bulking Sports Nutrition</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-md-5 mt-md-4 pb-5">

            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
            <p class="text-black-50 mb-5">Please enter your login and password!</p>

            <div class="form-outline form-white mb-4">
              <input type="text" id="user" class="form-control form-control-lg" />
              <label class="form-label" for="pass">Username</label>
            </div>

            <div class="form-outline form-white mb-4">
              <input type="password" id="pass" class="form-control form-control-lg" />
              <label class="form-label" for="pass">Password</label>
            </div>

          </div> 
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button onclick="loginCheck()" type="button" class="btn btn-primary">Click here to login</button>
    </div>
  </div>
</div>
</div>

<!-- StripBanner -->
<div>
    <p class="text-center"> Welcome to the World's No.1 Online Sports Nutrition Store | Free delivery over €40</p>
</div>
<!-- Carousel -->
<div>
    <p > <h2 class="text-center">Best Sellers</h2></p>
</div>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true"> <!--https://getbootstrap.com/docs/5.2/components/carousel/#content-->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/carousel/way.png" class="d-block w-100" alt="way protein">
      </div>
      <div class="carousel-item">
        <img src="img/carousel/fuel.png" class="d-block w-100" alt="fuel">
      </div>
      <div class="carousel-item">
        <img src="img/carousel/diet.png" class="d-block w-100" alt="diet">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!--Main/Product List -->

  <div class="p-5">
     <div class="d-flex justify-content-between align-items-center mb-5">
      <h1 class="fw-bold mb-0 text-black">Product List</h1>
      <h6 class="mb-0 text-muted">All items</h6>
    </div>

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

              <form metodh="post 
              "action="index.php?action=add&id=<?php echo $product['id']; ?>">
              <div class=""products>
      
              <hr class="my-4">

    <div class="row mb-4 d-flex justify-content-between align-items-center">
      <div class="col-md-2 col-lg-2 col-xl-2">
        <img
          src="<?php echo $product['image']; ?>"
          class="img-fluid rounded-3 shop-item-image" alt="<?php echo $product['name']; ?>">
      </div>
      <div class="col-md-3 col-lg-3 col-xl-3">
        <h6 class="text-black mb-0 shop-item-title"><?php echo $product['name']; ?></h6>
        <h6 class="text-muted"><?php echo $product['description']; ?></h6>
      </div>
      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
        <h6 class="mb-0 shop-item-price">€<?php echo $product['price']; ?></h6>
      </div>
      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
        <button type="button" class="btn btn-primary btn-block btn-lg shop-item-button" data-mdb-ripple-color="dark">Add To Cart</button>
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

    <!-- Main/Cart -->

        </section>
        <section class="container content-section">
            <h2 class="section-header" id="Cart">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">ITEM</span>
                <span class="cart-price cart-header cart-column">PRICE</span>
                <span class="cart-quantity cart-header cart-column">QUANTITY</span>
            </div>
            <div class="cart-items">
            </div>
            <div class="cart-total">
                <strong class="cart-total-title"><h3>Total</h3></strong>
                <span class="cart-total-price">$0</span>
            </div>
            <button class="btn btn-primary btn-purchase" type="button">PURCHASE</button>
        </section>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
</body>
</html>