<?php
  require_once "../../Controllers/cartController.php";

	session_start();
	if(!isset($_SESSION['userId']))
{
    // not logged in
    header('Location: ../Auth/login.php');
    exit();
}
$total = 0;

$msg = "";
if(isset($_GET["delete"])){
  $cartController = new CartController;
  $cartController->deleteFromCart($_SESSION["userId"],$_GET["product_id"]);
}

if(isset($_POST["update"])){
  $msg="Cart Updated Succesfully";
  $cartController = new CartController;
  $result = $cartController->getCardProducts($_SESSION["userId"]);
  for($i=0;$i<count($result);$i++){
    $cartController->updateInCart($_SESSION["userId"],$result[$i]["product_id"],$_POST["quantity".$i] - $result[$i]["quantity"]);
    if($_POST["quantity".$i]==0)
      $cartController->deleteFromCart($_SESSION["userId"],$result[$i]["product_id"]);
  }
  
  

}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="../Assests/favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="../Assests/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="../Assests/css/tiny-slider.css" rel="stylesheet">
		<link href="../Assests/css/style.css" rel="stylesheet">
		<title>Furni</title>
	</head>

	<body>
  <style>
    .Cbtn{
			width: 80%;
			border-radius:5px;
			background-color:#3b5d50;
			padding:10px; 
			border:none; 
			color:white; 
			font-size:20px;
			text-decoration: none;
			display: block;
      text-align: center;
			}
      .Cbtn:hover{
        color:white;
      }

      .msg{
        padding: 10px;
        color:#28a745;
        text-align:center; 
        margin-left:auto;
        margin-right:auto;
        margin-top:-5%;
        height:max-content;
        width: max-content;
        border-radius: 5px;
        color: white;
        /*font-size: 20px;*/
      }
  </style>
<!-- Start Header/Navigation -->
  <special-header></special-header>
<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section before-footer-section">
            <div class="container">
            <?php
              if($msg!=""){
                  ?>
                  <div class="msg" style="background-color: #28a74563;" >
                  <?php
                  echo $msg;
                  ?>
                  </div>
                <?php
              }
            ?>
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $cartController = new CartController;
                          $result = $cartController->getCardProducts($_SESSION["userId"]);
                          for($i=0;$i<count($result);$i++){
                              $total += ($result[$i]["quantity"] * $result[$i]["price"]);
                            ?>
                              <tr>
                                <td class="product-thumbnail">
                                  <img src="../Assests/uploaded_images/<?php echo $result[$i]["photo"] ?>" alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                  <h2 class="h5 text-black"><?php echo $result[$i]["name"] ?></h2>
                                </td>
                                <td>$<?php echo $result[$i]["price"] ?></td>
                                <td>
                                  <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                                    </div>
                                    <input type="text" class="form-control text-center quantity-amount" name="quantity<?php echo$i?>" value="<?php echo $result[$i]["quantity"] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-black increase" type="button">&plus;</button>
                                    </div>
                                  </div>
                                </td>
                                <td>$<?php echo ($result[$i]["quantity"] * $result[$i]["price"])?></td>
                                <td><a href="cart.php?user_id=<?php echo $_SESSION["userId"]?>&product_id=<?php echo $result[$i]["product_id"]?>&delete=" class="btn btn-black btn-sm">X</a></td>
                              </tr>
                            <?php
                          }

                        ?>
                        
                      </tbody>
                    </table>
                    <div >
                      <div class="col-md-6">
                        <div class="row mb-5">
                          <div class="col-md-6 mb-3 mb-md-0">
                            <button name="update" class="Cbtn">Update Cart</button>
                          </div>
                          <div class="col-md-6">
                            <a href="shop.php" class="Cbtn" >Continue Shopping</a>
                          </div>
                        </div>
                  </div>
                </form>
              </div>
        
              

                </div>
                <div class="col-md-20 pl-5" >
                  <div class="row justify-content" style="float:right;">
                    <div class="col-md-7" style="width: fit-content;">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$<?php echo $total?></strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		

		<!-- Start Footer Section -->
		<special-footer></special-footer>
		<!-- End Footer Section -->	

    <script src="../Assests/js/headerFooterManager.js"></script>
		<script src="../Assests/js/bootstrap.bundle.min.js"></script>
		<script src="../Assests/js/tiny-slider.js"></script>
		<script src="../Assests/js/custom.js"></script>
	</body>

</html>
