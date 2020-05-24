# AutomationTestsPHP
Automated acceptance tests with Codeception


## Commands to run before starting the tests
- Start selenium server: **java -jar "/path to the server/selenium-server-standalone-3.141.59.jar"**
- Start chrome driver: **chromedriver --url-base=/wd/hub**
- Latest version of **Chrome (Version 83)** browser is required

## Commands to run Codeception tests
This command will run all acceptance tests: **./vendor/bin/codecept run acceptance SigninCest.php**

## NOTE
In order the tests to work successfully, the following parameters must be provided:

#### File: acceptance.suite.yml
    modules:
       enabled:
          - WebDriver:
             url: '[YOUR APPLICATION URL]' #the base url of the application under test
             

#### File: SigninCest.php

    <?php
    class SigninCest
    {
        private $pass = '[YOUR PASSWORD]'; // the password of the user
        private $user = '[YOUR USERNAME]'; // the username
    ?>





