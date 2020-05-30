<?php

require_once 'config.php';

class AuthMethodsPageMobileAppCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('en/login/auth-methods/' . username);
        $I->dontSeeElement('.Loader__foreground');
        $I->dontSeeElement('.spinner.x2');
    }

    public function loginCodeNotNull(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
    }

    public function loginCancel(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->see('Cancel', ['css' => '.btn-danger']);
        $I->click('.btn-danger');
        $I->see('Login cancelled. Please retry or select another login mode.', ['css' => '.alert-info']);
    }

    public function haventReceivedCode(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->waitForElement('.text-center .text-center strong', 100);
        $I->see('Haven\'t received a code?', ['css' => '.text-center .text-center strong']);
        $I->click(['css' => '.text-center .text-center strong']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
    }

    public function loginCodeExpires(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->waitForElement('.alert-danger', 130);
        $I->see('Verification time expired', ['css' => '.alert-danger']);
        $I->see('Repeat', ['css' => 'button[type=button]']);
    }

    public function loginCodeReniew(AcceptanceTester $I)
    {
        $I->click(['css' => 'button[type=button]']);
        $I->waitForElement('.alert-danger', 130);
        $I->click(['css' => 'button[type=button]']);
        $I->assertNotNull(['css' => '.panel-body .text-center h1']);
    }

    public function linkNoMobileApp(AcceptanceTester $I)
    {
        $I->waitForElementVisible(['link' => 'I do not have the mobile app yet'], 10);
        $I->click(['link' => 'I do not have the mobile app yet']);
        $I->see('Do not have the application?', ['css' => '.panel-body .h4']);
        $I->seeElement(['css' => '.fa-apple']);
        $I->seeElement(['css' => '.fa-android']);
        $I->click(['link' => 'I have the mobile app']);
        $I->see('Log in', ['css' => 'button[type=button]']);
    }
}
