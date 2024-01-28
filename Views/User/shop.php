<?php
require_once "../../Controllers/adminController.php";
require_once "../../Controllers/cartController.php";

session_start();
$msg = "";

if(isset($_GET["add"]) && isset($_GET["id"])){
	$msg = "item added succesfully";
	$cart = new CartController;
	$result = $cart->checkInCard($_SESSION["userId"],$_GET["id"]);
	if(count($result)==0)
		$cart->addToCart($_SESSION["userId"],$_GET["id"],$_GET["name"],$_GET["photo"],$_GET["quantity"],$_GET["price"]);
	else{
		$cart->updateInCart($_SESSION["userId"],$_GET["id"], 1);
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
			.product-thumbnail{
				height: 20rem;
			}


			.addToCart{
			width: 108%;
			margin-left: -4%;
			border-radius:5px;
			background-color:#3b5d50;
			padding:10px; 
			border:none; 
			color:white; 
			font-size:20px;
			text-decoration: none;
			opacity: 0;
			display: block;
			-webkit-transition: .3s all ease;
			-o-transition: .3s all ease;
			transition: .3s all ease;
			}

			.product-item:hover .addToCart{
				transform: translateY(50px);
				opacity:1;
				color:white;
			}

			.msg{
				padding: 10px;
				color:#28a745;
				text-align:center; 
				margin-left:auto;
				margin-right:auto; 
				margin-top:20px;
				height:max-content;
				width: max-content;
				border-radius: 5px;
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
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		
		<?php
				if($msg!=""){
						?>
						<div class="msg" style="background-color: #28a74563; color:white">
						<?php
						echo $msg;
						?>
						</div>
					<?php
				}
			?>
		<div class="untree_co-section product-section before-footer-section">
			<div class="container">
				<div class="row">
					<form class="productsForm row">
						<?php
						$admin = new AdminController;
						$result = $admin->getProducts();
						for($i=0;$i<count($result);$i++){
						?>
							<div class="col-12 col-md-4 col-lg-3 mb-5 product-item" style="cursor: default;">
							
								<img src="../Assests/uploaded_images/<?php echo $result[$i]["photo"] ?>" class="img-fluid product-thumbnail">
								<h3 class="product-title" ><?php echo $result[$i]["name"]?></h3>
								<strong class="product-price"><?php echo "$".$result[$i]["price"]?></strong>
								<?php 
								if(isset($_SESSION["userId"])){
								?>
								<a class="addToCart cross" href="shop.php?id=<?php echo $result[$i]["id"]?>&add=<?php echo $msg?>
								&name=<?php echo $result[$i]["name"]?>&photo=<?php echo $result[$i]["photo"] ?>&quantity=1&price=<?php echo $result[$i]["price"]?>
								">Add To Cart</a>
								<?php	
								}
								?>
							
						</div>
						<?php
						}
					?>
					</form>
					
						
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
