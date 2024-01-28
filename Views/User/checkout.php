<?php
	require_once "../../Controllers/adminController.php";
	require_once "../../Controllers/cartController.php";
	session_start();
	if(!isset($_SESSION['userId']))
{
    // not logged in
    header('Location: ../Auth/login.php');
    exit();
}
$total = 0;
$discount = 0;
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

	<!-- Start Header/Navigation -->
		<special-header></special-header>
	<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Checkout</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="untree_co-section">
			<div class="container"> 
				<div class="row">
				<div class="col-md-6 mb-5 mb-md-0">
					<h2 class="h3 mb-3 text-black">Billing Details</h2>
					<div class="p-3 p-lg-5 border bg-white">
			
					<div class="form-group row">
						<div class="col-md-6">
						<label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="c_fname" name="c_fname" value="<?php echo$_SESSION["userFirstName"]?>" disabled>
						</div>
						<div class="col-md-6">
						<label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="c_lname" name="c_lname" value="<?php echo$_SESSION["userLastName"]?>" disabled>
						</div>
					</div>


					<div class="form-group row">
						<div class="col-md-12">
						<label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" require>
						</div>
					</div>


				

					<div class="form-group row mb-5">
						<div class="col-md-6">
						<label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
						<input type="number" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" require>
						</div>
					</div>

					


					

					

					</div>
				</div>

				
				<div class="col-md-6">

					<div class="row mb-5">
					<div class="col-md-12">
						<h2 class="h3 mb-3 text-black">Your Order</h2>
						<div class="p-3 p-lg-5 border bg-white">
						<table class="table site-block-order-table mb-5">
							<thead>
							<th>Product</th>
							<th>Total</th>
							</thead>
							<tbody>
							<?php
								if(isset($_SESSION["userId"])){
									$cartController = new CartController;
									$result = $cartController->getCardProducts($_SESSION["userId"]);
									for($i=0;$i<count($result);$i++){
										$total += ($result[$i]["quantity"] * $result[$i]["price"]);
										?>
										<tr>
											<td><?php echo $result[$i]["name"] ?> <strong class="mx-2">x</strong> <?php echo $result[$i]["quantity"] ?></td>
											<td>$<?php echo ($result[$i]["quantity"] * $result[$i]["price"])?></td>
										</tr>
										<?php
									}
								}
							?>
							<tr>
								<td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
								<td class="text-black">$<?php echo$total?></td>
							</tr>
							<tr>
								<td class="text-black font-weight-bold"><strong>Discount</strong></td>
								<td class="text-black font-weight-bold"><strong>
									<?php
										if($_SESSION["premium"]){
											$discount += 10;
											if($total >= 1000)
											$discount +=7;
										}
										else if($total >= 1000)
											$discount += 5;
										echo $discount;
									?>
									%
								</strong></td>
								
							</tr>
							<tr>
								<td class="text-black font-weight-bold"><strong>delievery</strong></td>
								<td class="text-black" id="delievery">$15.00</td>
								</tr>
							<tr>
								<td class="text-black font-weight-bold"><strong>Cart total</strong></td>
								<td class="text-black">$<?php echo $total - $discount ?></td>
							</tr>
							</tbody>
						</table>

						<div class="border p-3 mb-3 Cactive" id="pay" style="color: black;cursor: pointer;">
							pay on delievery
						</div>

						<div class="border p-3 mb-3 Cactive" style="cursor: pointer;" id="credit">
							<h3 class="h6 mb-0"><a style="text-decoration: none; " class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Credit card</a></h3>

							<div class="collapse" id="collapsecheque">
							<div class="py-2">
								<label for="creditCard" style="display:block"> Credit Card number</label>
								<input type="text" name="creditCard" style="text-decoration: none;" placeholder="XXXX XXXX XXXX XXXX" id="creditCard">
								<input type="text" name="creditCard" placeholder="CVV">
							</div>
							</div>
						</div>

						

						<div class="form-group">
							<button class="btn btn-black btn-lg py-3 btn-block" id="place">Place Order</button>
						</div>

						</div>
					</div>
					</div>

				</div>
				</div>
				<!-- </form> -->
			</div>
			</div>

		<!-- Start Footer Section -->
		<special-footer></special-footer>
		<!-- End Footer Section -->	
		<script>
			pay = document.querySelector("#pay");
			credit = document.querySelector("#credit");
			pay.style.backgroundColor="#3b5d5052";
			pay.onclick = function (){
				pay.style.backgroundColor="#3b5d5052";
				credit.style.backgroundColor="white";
			}

			credit.onclick = function (){
				credit.style.backgroundColor="#3b5d5052";
				pay.style.backgroundColor="white";
				delievery.innerHTML = "0";
			}
			place = document.querySelector("#place");
			phone = document.querySelector("#c_address")
			address = document.querySelector("#c_phone")
			checkButton = function (){
				if(phone.value == "" || address.value == "")
					place.disabled=true;
				else
					place.disabled=false;
			}
			checkButton();
			

			phone.onkeydown = function (){
				checkButton();
			}

			address.onkeydown = function (){
				checkButton();
			}

			place.onclick = function (){
				window.location='thankyou.html';
			}
			
				
				//onclick="'"


		</script>
		<script src="../Assests/js/headerFooterManager.js"></script>
		<script src="../Assests/js/bootstrap.bundle.min.js"></script>
		<script src="../Assests/js/tiny-slider.js"></script>
		<script src="../Assests/js/custom.js"></script>
	</body>

	</html>
