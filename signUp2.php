<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {
   $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
   $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);

   $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

   $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
   $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

   $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
   $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

   $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
   <title>EDUROS - SIGN UP</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   <link rel="stylesheet" type="text/css" href="assets/css/login.css">
   <link rel="icon" type="image/x-icon" href="assets/images/icons/eduros.ico">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
            <h3>Welcome To Eduros!</h3>
            <span>Create an account to continue to start learning</span>
         </div>
         <div class="form">
            <!-- Form -->
            <form action="signUp2.php" method="POST">
               <!-- Name -->
               <div class="form-flex">
                  <!-- First Name -->
                  <div class="first-name flex-item">
                     <label for="firstName">First Name</label>
                     <input type="text" class="text-input" id="firstName" name="firstName" placeholder="Jhon..." value="<?php getInputValue('firstName'); ?>" required autocomplete="off">
                     <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                  </div>
                  <!-- Last Name -->
                  <div class="last-name flex-item">
                     <label for="lastName">Last Name</label>
                     <input type="text" id="lastName" class="text-input" name="lastName" placeholder="Doe..." autocomplete="off" value="<?php getInputValue('lastName'); ?>" required>
                     <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                  </div>
               </div>

               <!-- Username -->
               <label for="username">Username</label>
               <input type="text" name="username" id="lastName" class="text-input" placeholder="jhondoe42..." autocomplete="off" value="<?php getInputValue('username'); ?>" required>
               <?php echo $account->getError(Constants::$usernameCharacters); ?>
               <?php echo $account->getError(Constants::$usernameTaken); ?>

               <!-- @Mail -->
               <label for="email">Email</label>
               <input type="email" name="email" id="email" class="text-input" placeholder="example@mail.com" autocomplete="off" value="<?php getInputValue('email'); ?>" required>
               <label for="email2">Confirm Email</label>
               <input type="email" name="email2" id="email2" class="text-input" placeholder="example@mail.com" autocomplete="off" value="<?php getInputValue('email2'); ?>" required>
               <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
               <?php echo $account->getError(Constants::$emailInvalid); ?>
               <?php echo $account->getError(Constants::$emailTaken); ?>

               <!-- Password -->
               <div class="form-flex">
                  <div class="pass-1 flex-item">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="text-input" placeholder="6 Characters at least..." autocomplete="off" required>
                  </div>
                  <div class="pass-2 flex-item">
                     <label for="password2">Confirm Password</label>
                     <input type="password" name="password2" id="password2" class="text-input" placeholder="6 Characters at least..." autocomplete="off" required>
                  </div>
               </div>
               <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
               <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
               <?php echo $account->getError(Constants::$passwordLength); ?>

               <!-- Submit Button -->
               <input type="submit" class="submitButton" name="submitButton" value="Sign Up">

            </form>
            <!-- End Form -->
            <p>Already have an account? <a href="SignIn2.php" class="signUpLink">Sign In</a></p>
         </div>

      </div>
   </div>
   <div class="body-item2">

   </div>
</body>

</html>