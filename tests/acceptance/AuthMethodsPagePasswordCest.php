<?php

require_once 'config.php';

class AuthMethodsPagePasswordCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('en/login/auth-methods/' . username);
        $I->dontSeeElement('.spinner.x2');
    }

    public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->click(['css' => '#login-methods-heading-user_credentials']);
        $I->waitForElementVisible('input[type=password]', 10);
        $I->fillField(['css' => 'input[type=password]'], password);
        $I->click('button[type=submit]');
        $I->see('Account Overview', ['css' => '.page-title']);
    }

    public function signInInvalidPassword(AcceptanceTester $I)
    {
        $I->click(['css' => '#login-methods-heading-user_credentials']);
        $I->waitForElementVisible('input[type=password]', 10);
        $I->fillField('#password', '*');
        $I->click('button[type=submit]');
        $I->see('Incorrect password. Please try again.', ['css' => '.alert-danger span']);
    }

    public function linkResetPassword(AcceptanceTester $I)
    {
        $I->click(['css' => '#login-methods-heading-user_credentials']);
        $I->waitForElementVisible('input[type=password]', 10);
        $I->click(['link' => 'Forgot password?']);
        $I->see('Password reset', ['css' => '.panel-heading-narrow.text-center']);
        $I->seeInCurrentUrl('/reset-password/');
    }
}
