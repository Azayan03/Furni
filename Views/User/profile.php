<?php

	require_once "../../Controllers/authController.php";
	require_once "../../Models/user.php";
	$msg = "";
	$error_msg = "";

	session_start();
	if(!isset($_SESSION['userId']))
{
    // not logged in
    header('Location: ../Auth/login.php');
    exit();
}

if(isset($_POST["delete"])){
	$auth = new AuthController();
	$auth->deleteUser($_SESSION['userId']);
	session_unset();
    session_destroy();
    header("location: ../Auth/login.php");
}

if(isset($_POST["update"])){
	
	if(empty($_POST["phoneNumber"])||empty($_POST["firstName"])||empty($_POST["lastName"])){
		$error_msg = "Please fill all the details";
	}
	else{
		$auth = new AuthController();
		$user = new User();
		$user->setFirstName($_POST["firstName"]);
		$user->setLastName($_POST["lastName"]);
		$user->setPhoneNumber($_POST["phoneNumber"]);
		$auth->updateDetails($user,$_SESSION['userId']);
		$msg = "Updated Succesfully";
		$_SESSION["userFirstName"]=$user->getFirstName();
		$_SESSION["userLastName"]=$user->getLastName();
		$_SESSION["userPhoneNumber"]=$user->getPhoneNumber();
	//$_SESSION["userPhoto"]=$user->getFirstName();
	}
}

if(isset($_POST["changePassword"])){
	if(empty($_POST["oldPassword"])||empty($_POST["newPassword"])||empty($_POST["confirmPassword"])){
		$error_msg = "Please fill all the details";
	}
	else{
		$auth = new AuthController();
		$check=$auth->checkPassword($_POST["oldPassword"],$_SESSION['userId']);
		if($check){
			if($_POST["newPassword"]!=$_POST["confirmPassword"]){
				$error_msg = "passwords Don't match ";
			}
			else{
				if($check){
					$auth->changePassword($_POST["newPassword"],$_SESSION['userId']);
					$msg="Password Updated Succesfully";
				}
			}
		}
		else{
				$error_msg = "Wrong Password";
			}
		
	}
}


if(isset($_POST["upload"]) && isset($_FILES["photo"])){
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
			$auth = new AuthController;
			$auth->uploadPhoto($new_image_name,$_SESSION["userId"]);
			$_SESSION["userPhoto"] = $new_image_name;
		}
		else{
			$error_msg = "You can't upload images of this type";
		}
	}
	else{
		$error_msg = "Unknown error happened in image";
	}
}

if(isset($_POST["remove"])){
	$auth = new AuthController;
	$auth->removePhoto($_SESSION["userId"]);
	$_SESSION["userPhoto"]="";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
		<link href="../Assests/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="../Assests/css/tiny-slider.css" rel="stylesheet">
		<link href="../Assests/css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="../Assests/favicon.png">
		<title>Furni</title>
</head>
<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<style>
body{
	background-color: #eff2f1;
	}
	
	.rounded {
		border-radius: 5px !important;
	}
	.py-5 {
		padding-top: 3rem !important;
		padding-bottom: 3rem !important;
	}
	.px-4 {
		padding-right: 1.5rem !important;
		padding-left: 1.5rem !important;
	}
	.bg-secondary-soft {
		background-color: rgba(208, 212, 217, 0.1) !important;
		padding: 1rem !important;
	}
	.file-upload .square {
		height: 250px;
		width: 250px;
		margin: auto;
		vertical-align: middle;
		border: 1px solid #e5dfe4;
		background-color: #fff;
		border-radius: 5px;
	}
	.text-secondary {
		--bs-text-opacity: 1;
		color: rgba(208, 212, 217, 0.5) !important;
	}
	.btn-success-soft {
		color: #28a745;
		background-color: rgba(40, 167, 69, 0.1);
	}
	.btn-danger-soft {
		color: #dc3545;
		background-color: rgba(220, 53, 69, 0.1);
	}
	.form-control {
		display: block;
		width: 100%;
		padding: 0.5rem 1rem;
		font-size: 0.9375rem;
		font-weight: 400;
		line-height: 1.6;
		color: #29292e;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #e5dfe4;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		border-radius: 5px;
		-webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
	}
	
	.bg-secondary-soft{
		background-color: #3b5d50;
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

	input[type="file"] {
    display: none;
	}

	#customFile{
		margin-bottom: 5%;
		border: 1px solid #ccc;
		display: inline-block;
		padding: 6px 12px;
		cursor: pointer;
	}
	

    </style>
    <special-header></special-header>
    <div class="container">
    <div class="row" style="margin-top: -1rem;">
		<div class="col-12">
			<!-- Page title -->
			<div class="my-5" style="width: 100%;">
				<h3>My Profile</h3>
				<hr>
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
			</div>
			<!-- Form START -->
			<form class="file-upload" method="post" enctype="multipart/form-data">
				<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded" >
							<div class="row g-3">
								<h4 class="mb-4 mt-0" style="margin-top: 1rem !important;">Contact detail</h4>
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">First Name *</label>
									<input type="text" name="firstName" class="form-control" placeholder="" value="<?php echo $_SESSION["userFirstName"] ?>" aria-label="First name" >
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Last Name *</label>
									<input type="text" name="lastName" class="form-control" placeholder="" value="<?php echo $_SESSION["userLastName"] ?>" aria-label="Last name" >
								</div>
								<!-- Phone number -->
								<div class="col-md-6">
									<label class="form-label">Phone number *</label>
									<input type="text" name="phoneNumber" class="form-control" placeholder="" value="<?php echo $_SESSION["userPhoneNumber"] ?>" aria-label="Phone number" >
								</div>
								<!-- Email -->
								<div class="col-md-6">
									<label for="inputEmail4" class="form-label">Email *</label>
									<input type="email" name="email" class="form-control" id="inputEmail4" readonly disabled value="<?php echo $_SESSION["userEmail"] ?>" style="cursor: not-allowed;">
								</div>
							</div> <!-- Row END -->
						</div>
					</div>
					<!-- Upload profile -->
					<div class="col-xxl-4">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0" style="text-align: center; padding-top: 1rem !important;">Upload your profile photo</h4>
								<div class="text-center">
									<!-- Image upload -->
									<div class="square position-relative display-2 mb-3">
										<?php
											if($_SESSION["userPhoto"]){
												?>
												<img style="width:inherit; height:inherit" src="../Assests/uploaded_images/<?php echo $_SESSION["userPhoto"];?>" >
											<?php
											}
										?>
											
										<?php
											if($_SESSION["userPhoto"]==""){
												?>
												<i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
											<?php
											}
										?>
												
									</div>
									<!-- Button -->
									<input type="file" id="customFile" name="photo" >
									<button class="btn btn-success-soft btn-block" name="upload" >Upload</button>
									<button class="btn btn-danger-soft" name="remove">Remove</button>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Row END -->

				<div class="row mb-5 gx-5" style="margin-top: -8rem !important;">
					
					<!-- change password -->
					<div class="col-xxl-6" style="margin-bottom: 4rem;">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="my-4">Change Password</h4>
								<!-- Old password -->
								<div class="col-md-6">
									<label for="exampleInputPassword1" class="form-label">Old password *</label>
									<input type="password" name="oldPassword" class="form-control" id="exampleInputPassword1">
								</div>
								<!-- New password -->
								<div class="col-md-6">
									<label for="exampleInputPassword2"  class="form-label">New password *</label>
									<input type="password" name="newPassword" class="form-control" id="exampleInputPassword2">
								</div>
								<!-- Confirm password -->
								<div class="col-md-12">
									<label for="exampleInputPassword3"  class="form-label">Confirm Password *</label>
									<input type="password" name="confirmPassword" class="form-control" id="exampleInputPassword3">
								</div>
							</div>
							<button class="btn btn-primary " style="margin-top: 5%; margin-left:30%" name="changePassword">changePassword</button>
						</div>
					</div>
				</div> <!-- Row END -->
				<!-- button -->
				<div class="gap-3 d-md-flex justify-content-md-end text-center" style="margin-top: -17rem;">
					<button class="btn btn-primary btn-lg" name="update">Update profile</button>
					<button class="btn btn-danger btn-lg" name="delete">Delete profile</button>
				</div>
			</form> <!-- Form END -->
			<div class="logout" style="float: right; margin-top: 2rem; margin-right: 3rem;">
				<a href="../Auth/logout.php"><button type="button" class="btn btn-danger-soft" style="width: 20rem !important; background-color: #dc35465e; ">Log Out</button></a>
			</div>
		</div>
	</div>
	</div>
    <script src="../Assests/js/headerFooterManager.js"></script>
</body>
</html>