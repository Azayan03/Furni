<?php
	require_once "../../Controllers/adminController.php";

	session_start();
	if(!isset($_SESSION['userId'])||$_SESSION["userRole"]!="admin")
{
    // not logged in
    header('Location: ../Auth/login.php');
    exit();
}
$error_msg = "";
	if(isset($_POST["name"]) && isset($_POST["price"]) && isset($_FILES["photo"]) ){
		if(!empty($_POST["name"]) && !empty($_POST["price"]) && !empty($_FILES["photo"])){
			if(isset($_FILES["photo"])){
				$image_name = $_FILES["photo"]["name"];
				$image_size = $_FILES["photo"]["size"];
				$image_tmp_name = $_FILES["photo"]["tmp_name"];
				$image_error = $_FILES["photo"]["error"];
				if($image_error === 0){
					$image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
					$image_extension_lowercase = strtolower($image_extension);
					$allowed_extensions = ["jpg", "jpeg", "png"];
					
					if(in_array($image_extension, $allowed_extensions)){
						$new_image_name = uniqid("IMG-", true).'.'.$image_extension_lowercase;
						$image_upload_path = "../Assests/uploaded_images/".$new_image_name;
						move_uploaded_file($image_tmp_name, $image_upload_path);
						$admin = new AdminController;
						$admin->addProduct($_POST["name"], $_POST["price"], $new_image_name);
					}
					else{
						$error_msg = "You can't upload images of this type";
					}
				}
				else{
					$error_msg = "Unknown error happened in image";
				}
				
			}
			
			
		}
		else{
			$error_msg = "fill every thing";
		}
	
	}

	if(isset($_GET["id"])){
		$admin = new AdminController;
		$admin->deleteProduct($_GET["id"]);
	}

?>





<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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


            .cbtn{
				height: 60px;
				font-size: 25px;
				width: 50%;
				background-color: #c99f2c;
				transition: 0.3s all ease;
				margin: 10px;
				margin-left: 40%;
				
            }

            .cbtn:hover{
                transform: scale(1.1);
                background-color: #c99f2c ;
                
            }
			
			.invisible{
				display: none;
			}
			
			.popupForm{
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				display: flex;
				align-items: center;
				justify-content: center;
				margin: auto;
				background-color: rgba(0, 0, 0, 0.47);
				z-index: 100;
			}

			.form{
				display: flex;
				flex-direction: column;
				background-color: white;
				padding: 50px;
				border-radius: 20px;
				width: 50%;
				height: 80%;

			}

			input{
				width:60%;
				margin: 10px;
			}
			label{
				margin: 10px;
			}

			.deleteBtn{
			width: 108%;
			margin-left: -4%;
			border-radius:5px;
			background-color:rgba(190, 0, 0, 1); 
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


			.product-item:hover .deleteBtn{
				transform: translateY(50px);
				opacity:1;
				color:white;
			}


			.closeBtn{
				width:30px;
				float:right;
				transition: background-color, transform 0.3s ease;
				border-radius: 5px;
				cursor: pointer;
			}

			.closeBtn:hover{
				transform: scale(1.1);
				background-color: rgba(0, 0, 0, 0.40);
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

<!-- pop up add item start -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="popupForm invisible">
	<form class="form" method="post" enctype="multipart/form-data">
		<span class="icon-cross">
			<img src="../Assests/images/close_icon.svg" class="closeBtn">
		</span>
		<label for="name" >Name :</label>
		<input class="input" type="text" id="name" name="name">

		<label for="price" >Price :</label>
		<input class="input" type="number" id="price" name="price">

		<label for="photo" >Photo :</label>
		<input class="input" type="file" style="width: 60%;border: 1px solid #746565;cursor:pointer;" id="photo" name="photo" >
		<button class="add btn" name="add" style="width: 200px; margin-left:auto;margin-right:auto; margin-top:5%; ">Add</button>
		<?php
				if($error_msg!=""){
						?>
						<div class="msg" style="background-color: #e88484; color:white">
						<?php
						echo $error_msg;
						?>
						</div>
					<?php
				}
			?>

	</form>
</div>
<!-- pop up add item end-->
		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7" style="height: 120px;display: flex;width: 50%;flex-direction: column;justify-content: space-between;">
                        <button class="btn  cbtn" name="upload" id="add" >add item</button>
						<div class="logout">
							<a href="../Auth/logout.php"><button type="button" class="btn cbtn" style="width: 20rem !important; background-color: rgba(142, 22, 26, 1); ">Log Out</button></a>
						</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
			<div class="container">
				<div class="row">
					<form class="productsForm row">
						<?php
						$admin = new AdminController;
						$result = $admin->getProducts();
						for($i=0;$i<count($result);$i++){
						?>
							<div class="col-12 col-md-4 col-lg-3 mb-5 product-item" >
							
								<img src="../Assests/uploaded_images/<?php echo $result[$i]["photo"] ?>" class="img-fluid product-thumbnail">
								<h3 class="product-title" ><?php echo $result[$i]["name"]?></h3>
								<strong class="product-price"><?php echo "$".$result[$i]["price"]?></strong>
								<a class="deleteBtn cross" href="index.php?id=<?php echo $result[$i]["id"]?>" >Delete</a>
							
						</div>
						<?php
						}
					?>
					</form>
					
						
				</div>
			</div>
		</div>


        
		<script src="../Assests/js/bootstrap.bundle.min.js"></script>

		<script defer src="../Assests/js/admin.js"></script>
	</body>

</html>
