<?php
require_once "../../Models/user.php";
require_once "../../Controllers/authController.php";
    $errorMessage="";
    $errorMessage_signup="";
if(isset($_POST["email"])&&isset($_POST["password"]))
{
    if(!empty($_POST["email"])&&!empty($_POST["password"]))
    {
        $user = new User();
        $auth = new AuthController();
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);
        if($auth->login($user)){
            if(isset($_SESSION["userRole"])){
                if($_SESSION["userRole"]=="user")
                {
                    header("location: ../User/index.html");
                }
                else
                {
                    header("location: ../Admin/index.php");
                }
            }
            
        }
        else{
            $errorMessage="Incorrect Email or Password";
        }
    }
    else
    {
        $errorMessage="please fill all fields";
    }
}

if(isset($_POST["Semail"]) && isset($_POST["Spassword"]) && isset($_POST["fname"]) && isset($_POST["lname"])){
    if(!empty($_POST["Semail"]) && !empty($_POST["Spassword"]) && !empty($_POST["fname"])  && !empty($_POST["lname"])){
        
        $user = new User();
        $auth = new AuthController();
        $user->setEmail($_POST["Semail"]);
        $user->setPassword($_POST["Spassword"]);
        $user->setFirstName($_POST["fname"]);
        $user->setLastName($_POST["lname"]);
        if(!$auth->signUp($user)){
            $errorMessage_signup="Invalid Email";
        }  
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="../Assests/favicon.png">
    <link rel="stylesheet" href="../Assests/css/loginStyle.css">
    <title>Furni</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="https://www.facebook.com/amdoka99/" target="_blank"  class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://github.com/Rmdn7" target="_blank"  class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/ahmad-ramadan-307b20230/" target="_blank" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <?php if($errorMessage_signup!="")
                    {
                        ?>
                        <div class="warning">
                        <?php
                        echo $errorMessage_signup
                        ?>
                        </div>
                    <?php
                    }    
                ?>
                <input type="text" placeholder="First name" name="fname" required>
                <input type="text" placeholder="Last name" name="lname" required>
                <input type="email" placeholder="Email" name="Semail" required>
                <input type="password" placeholder="Password" name="Spassword" required>
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="Post">
                <h1>Log In</h1>
                <div class="social-icons">
                    <a href="https://www.facebook.com/amdoka99/" target="_blank"  class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://github.com/Rmdn7" target="_blank"  class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/ahmad-ramadan-307b20230/" target="_blank"  class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                
                    <?php if($errorMessage!="")
                    {
                        ?>
                        <div class="warning">
                        <?php
                        echo $errorMessage
                        ?>
                        </div>
                    <?php
                    }    
                    ?>
                
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your Information to make account in our page</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello</h1>
                    <p>Register with your personal details to login in our page</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../Assests/js/loginAnimation.js"></script>
</body>
</html>