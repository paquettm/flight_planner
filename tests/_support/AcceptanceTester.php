<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */
        /**
     * @Given I am on the page :url
     */
     public function iAmOnThePage($url)
     {
         $this->amOnPage($url);
     }

    /**
     * @When I input :term in the :boxname box
     */
     public function iInputInTheBox($term, $boxname)
     {
         $this->fillField($boxname, $term);
     }

    /**
     * @When I click :text
     */
     public function iClick($text)
     {
         $this->click($text);
     }

    /**
     * @Then I see :text
     */
     public function iSee($text)
     {
         $this->see($text);
     }

}
