<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {

   $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
   $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

   $wasSuccessful = $account->login($username, $password);

   if ($wasSuccessful) {
      $_SESSION["userLoggedIn"] = $username;
      header("Location: index.php");
   }
}

function getInputValue($name)
{
   if (isset($_POST[$name])) {
      echo $_POST[$name];
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <title>EDUROS - SIGN IN</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="assets/css/login.css">
   <link rel="icon" type="image/x-icon" href="assets/images/icons/eduros.ico">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>

<body>
   <div class="body-item1">
      <div class="main">
         <div class="logo-img">
            <a href="index.php">
               <img src="assets/images/icons/EDUROS.svg" alt="eduros-logo">
            </a>
         </div>
         <div class="intro">
            <h3>Hello Again!</h3>
            <span>Sign in to continue to Eduros</span>
         </div>
         <div class="form">
            <!-- Form -->
            <form action="signIn2.php" method="POST">
               <!-- Username -->
               <label for="username">Username</label>
               <input type="text" class="text-input" id="username" name="username" placeholder="Username" value="<?php getInputValue('username'); ?>" required autocomplete="off"><br>
               <!-- Password -->
               <label for="password">Password</label>
               <input type="password" id="password" class="text-input" name="password" placeholder="Password" required><br>
               <input type="submit" class="submitButton" name="submitButton" value="Sign In">
               <?php echo $account->getError(Constants::$loginFailed); ?>
            </form>
            <!-- End Form -->
            <p>You dont have an account? <a href="SignUp2.php" class="signUpLink">Sign Up</a></p>
         </div>
      </div>
   </div>
   <div class="body-item2">

   </div>


</body>

</html>