<head>
    <title>EDUROS - SETTINGS</title>
</head>
<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/SettingsFormProvider.php");
require_once("includes/classes/Constants.php");

if (!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$detailsMessage = "";
$passwordMessage = "";
$formProvider = new SettingsFormProvider();

if (isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormString($_POST["email"]);

    if ($account->updateDetails($firstName, $lastName, $email, $userLoggedInObj->getusername())) {
        $detailsMessage = "<div class='alert alert-success'>
                                <strong>SUCCESS!</strong> Details updated successfully!
                            </div>";
    } else {
        $errorMessage = $account->getFirstError();

        if ($errorMessage == "") $errorMessage = "Something went wrong";

        $detailsMessage = "<div class='alert alert-danger'>
                                <strong>ERROR!</strong> $errorMessage
                            </div>";
    }
}

if (isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

    if ($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedInObj->getusername())) {
        $passwordMessage = "<div class='alert alert-success'>
                                <strong>SUCCESS!</strong> Password updated successfully!
                            </div>";
    } else {
        $errorMessage = $account->getFirstError();

        if ($errorMessage == "") $errorMessage = "Something went wrong";

        $passwordMessage = "<div class='alert alert-danger'>
                                <strong>ERROR!</strong> $errorMessage
                            </div>";
    }
}
?>
<div class="settingsContainer column">
    <style>
        .text-input {
            width: 100%;
            margin: 0 0 1rem 0;
            border: 1.5px solid #dedede;
            padding: 15px 15px;
            transition: all 0.30s ease-in-out;
            border-radius: 15px;
            caret-color: #5c1feb;
        }

        .text-input:focus {
            border: 1.5px solid #5c1feb75;
            box-shadow: 0 0 5px #5c1feb70;
            outline: 0;

        }


        .form label {
            margin: 0 0 4px 4px;
            font-weight: 500;
        }

        .submitButton {
            width: 200px;
            margin: 1rem 0 2rem 0;
            padding: 15px 15px;
            border: 0;
            border-radius: 15px;
            color: #fff;
            background-color: #5c1feb;
            transition: all 0.30s ease-in-out;
            cursor: pointer;
        }

        .submitButton:hover {
            box-shadow: 0 0 8px #5c1feb;
        }

        .title {
            color: #5c1feb;
        }
    </style>
    <div class="formSection">
        <div class="message">
            <?php echo $detailsMessage; ?>
        </div>
        <?php
        echo $formProvider->createUserDetailsForm(
            isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
            isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getLastName(),
            isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getEmail()
        );
        ?>
    </div>

    <div class="formSection">
        <div class="message">
            <?php echo $passwordMessage; ?>
        </div>
        <?php
        echo $formProvider->createPasswordForm();
        ?>
    </div>

</div>