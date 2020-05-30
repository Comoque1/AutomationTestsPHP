<?php

class GeneralCest
{
    /**
     * @example {"code":"en","message":"+44xxxxxxxx"}
     * @example {"code":"lt","message":"+370xxxxxxxx"}
     * @example {"code":"ru","message":"+7xxxxxxxx"}
     * @example {"code":"pl","message":"+48xxxxxxxx"}
     * @example {"code":"lv","message":"+371xxxxxxxx"}
     * @example {"code":"bg","message":"+359xxxxxxxx"}
     * @example {"code":"es","message":"+34xxxxxxxx"}
     * @example {"code":"et","message":"+372xxxxxxxx"}
     * @example {"code":"de","message":"+49xxxxxxxx"}
     * @example {"code":"ro","message":"+40xxxxxxxx"}
     */

    public function verifyCountryCodes(AcceptanceTester $I, \Codeception\Example $example)
    {
        $I->amOnPage($example['code'] . '/login');
        $I->see('For example: email@example.com or ' . $example['message'], ['css' => '.help-block']);
    }
}
