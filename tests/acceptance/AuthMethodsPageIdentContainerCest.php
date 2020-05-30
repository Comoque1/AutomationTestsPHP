<?php

require_once 'config.php';

class AuthMethodsPageIdentContainerCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('en/login/auth-methods/' . username);
        $I->dontSeeElement('.Loader__foreground');
        $I->dontSeeElement('.spinner.x2');
    }

    public function verifyComponents(AcceptanceTester $I)
    {
        $I->seeElement(['css' => '.ti-pencil']);
        $I->seeElement(['css' => '.user-avatar']);
        $I->see(username, ['css' => '.user-identifier-row strong']);
        $I->see('Mobile app', ['css' => '#login-methods-heading-app_credentials .h5']);
        $I->see('Password', ['css' => '#login-methods-heading-user_credentials .h5']);
    }

    public function changeUserIdentifier(AcceptanceTester $I)
    {
        $I->click(['css' => '.ti-pencil']);
        $I->see('LOG IN', ['css' => '.panel-title']);
        $I->see('', ['css' => '#userIdentifier']);
    }
}
