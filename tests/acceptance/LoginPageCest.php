<?php

require_once 'config.php';

class LoginPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('en/login/');
        $I->dontSeeElement('.spinner.x2');
        $I->SeeElement('.Loader');
    }

    public function validUsername(AcceptanceTester $I)
    {
        $I->fillField(['css' => '#userIdentifier'], username);
        $I->click(['css' => 'button[type=submit]']);
        $I->dontSeeElement('.spinner.x2');
        $I->see('Password', ['css' => '#login-methods-heading-user_credentials .h5']);
    }

    /**
     * @example {"username":"+35988"}
     * @example {"username":"t@test.com"}
     * @example {"username":"+@"}
     */
    public function invalidUsername(AcceptanceTester $I, \Codeception\Example $example)
    {
        $I->fillField(['css' => '#userIdentifier'], $example['username']);
        $I->click(['css' => 'button[type=submit]']);
        $I->dontSeeElement('.spinner.x2');
        $I->see('The specified user could not be found', ['css' => '.alert-danger div']);
    }

    public function linkRegisterNow(AcceptanceTester $I)
    {
        $I->click(['link' => 'Register Now!']);
        $I->see('Account Registration', ['css' => '#registration-h1']);
        $I->seeInCurrentUrl('/registration#/');
    }
}
