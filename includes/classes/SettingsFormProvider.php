<?php
class SettingsFormProvider
{

    public function createUserDetailsForm($firstName, $lastName, $email)
    {
        $firstNameInput = $this->createFirstNameInput($firstName);
        $lastNameInput = $this->createLastNameInput($lastName);
        $emailInput = $this->createEmailInput($email);
        $saveButton = $this->createSaveUserDetailsButton();

        return "<form action='settings.php' method='POST' enctype='multipart/form-data'>
                    <h4 class='title mb-0'>User details</h4>
                    <p class='mb-4' style='color: #929292;'>Update your personnal information</p>
                    $firstNameInput
                    $lastNameInput
                    $emailInput
                    $saveButton
                </form>";
    }

    public function createPasswordForm()
    {
        $oldPasswordInput = $this->createPasswordInput("oldPassword", "Old password");
        $newPassword1Input = $this->createPasswordInput("newPassword", "New password");
        $newPassword2Input = $this->createPasswordInput("newPassword2", "Confirm new password");

        $saveButton = $this->createSavePasswordButton();

        return "<form action='settings.php' method='POST' enctype='multipart/form-data'>
                    <h4 class='title mb-0'>Update password</h4>
                    <p class='mb-4' style='color: #929292;'>Update your password</p>
                    $oldPasswordInput
                    $newPassword1Input
                    $newPassword2Input
                    $saveButton
                </form>";
    }

    private function createFirstNameInput($value)
    {
        if ($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='text-input' type='text' placeholder='First name' name='firstName' value='$value' required>
                </div>";
    }

    private function createLastNameInput($value)
    {
        if ($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='text-input' type='text' placeholder='Last name' name='lastName' value='$value' required>
                </div>";
    }

    private function createEmailInput($value)
    {
        if ($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='text-input' type='email' placeholder='Email' name='email' value='$value' required>
                </div>";
    }

    private function createSaveUserDetailsButton()
    {
        return "<button type='submit' class='submitButton' name='saveDetailsButton'>Save</button>";
    }

    private function createSavePasswordButton()
    {
        return "<button type='submit' class='submitButton' name='savePasswordButton'>Save</button>";
    }

    private function createPasswordInput($name, $placeholder)
    {

        return "<div class='form-group'>
                    <input class='text-input' type='password' placeholder='$placeholder' name='$name' required>
                </div>";
    }
}
