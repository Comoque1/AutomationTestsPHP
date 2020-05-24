<?php

class SigninCest
{
    private $pass = '[YOUR PASSWORD]';
    private $user = '[YOUR USERNAME]';

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('en/login');
        $I->fillField(['css' => '#userIdentifier'], $this->user);
        $I->click(['css' => 'button[type=submit]']);
    }

    // tests

    public function verifyAuthMethodsComponents(AcceptanceTester $I)
    {
        $I->seeElement(['css' => '.ti-pencil']);
        $I->seeElement(['css' => '.user-avatar']);
        $I->see($this->user, ['css' => '.user-identifier-row strong']);
        $I->see('Mobile app', ['css' => '#login-methods-heading-app_credentials .h5']);
        $I->see('Password', ['css' => '#login-methods-heading-user_credentials .h5']);
    }

    public function changeUserIdentifier(AcceptanceTester $I)
    {
        $I->seeElement(['css' => '.ti-pencil']);
        $I->click(['css' => '.ti-pencil']);
        $I->see('LOG IN', ['css' => '.panel-title']);
        $I->see('', ['css' => '#userIdentifier']);
    }

    public function mobileAppLoginCodeNotNull(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
    }

    public function mobileAppLoginCancel(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->see('Cancel', ['css' => '.btn-danger']);
        $I->click('.btn-danger');
        $I->see('Login cancelled. Please retry or select another login mode.', ['css' => '.alert-info']);
    }

    // To Do
    // public function mobileAppLoginRejectedFromPhone(AcceptanceTester $I)
    // {}

    // To Do
    // public function mobileAppLoginAcceptedFromPhone(AcceptanceTester $I)
    // {}

    public function signInInvalidPassword(AcceptanceTester $I)
    {
        $I->click(['css' => '#login-methods-heading-user_credentials']);
        $I->fillField(['css' => '#password'], '*');
        $I->click(['css' => 'button[type=submit]']);
        $I->see('Incorrect password. Please try again.', ['css' => '.alert-danger span']);
    }

    public function signInInvalidUsername(AcceptanceTester $I)
    {
        $I->amOnPage('en/login');
        $I->fillField(['css' => '#userIdentifier'], '+35980');
        $I->click(['css' => 'button[type=submit]']);
        $I->see('The specified user could not be found', ['css' => '.alert-danger div']);
        $I->amOnPage('en/login');
        $I->fillField(['css' => '#userIdentifier'], 't@test.com');
        $I->click(['css' => 'button[type=submit]']);
        $I->see('The specified user could not be found', ['css' => '.alert-danger div']);
        $I->amOnPage('en/login');
        $I->fillField(['css' => '#userIdentifier'], '@');
        $I->click(['css' => 'button[type=submit]']);
        $I->see('The specified user could not be found', ['css' => '.alert-danger div']);
    }

    public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->click(['css' => '#login-methods-heading-user_credentials']);
        $I->fillField(['css' => '#password'], $this->pass);
        $I->click(['css' => 'button[type=submit]']);
        $I->see('Account Overview', ['css' => '.page-title']);
    }

    public function linkRegisterNow(AcceptanceTester $I)
    {
        $I->click(['link' => 'Register Now!']);
        $I->see('Account Registration', ['css' => '#registration-h1']);
    }

    public function linkResetPassword(AcceptanceTester $I)
    {
        $I->click(['css' => '#login-methods-heading-user_credentials']);
        $I->click(['link' => 'Forgot password?']);
        $I->see('Password reset', ['css' => '.panel-heading-narrow.text-center']);
    }

    public function linkNoMobileApp(AcceptanceTester $I)
    {
        $I->click(['link' => 'I do not have the mobile app yet']);
        $I->see('Do not have the application?', ['css' => '.panel-body .h4']);
        $I->seeElement(['css' => '.fa-apple']);
        $I->seeElement(['css' => '.fa-android']);
        $I->click(['link' => 'I have the mobile app']);
        $I->see('Log in', ['css' => 'button[type=button]']);
    }

    public function mobileAppLoginCodeExpiresAndReniewCode(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
        $I->waitForElement('.alert-danger', 130);
        $I->see('Verification time expired', ['css' => '.alert-danger']);
        $I->see('Repeat', ['css' => 'button[type=button]']);
        $I->click(['css' => 'button[type=button]']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
    }

    public function mobileAppLoginHaventReceivedCode(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
        $I->waitForElement('.text-center .text-center strong', 100);
        $I->see('Haven\'t received a code?', ['css' => '.text-center .text-center strong']);
        $I->click(['css' => '.text-center .text-center strong']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
    }

}
