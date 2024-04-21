Feature: newAnimal
  In order to add new animals for owners
  As a user
  I need to bet able to fill a form and submit it to create a new animal

  Scenario: Create a blue cat
    Given I am on the page "/Animal/create"
    When I input "blue cat" in the "name" box
    And I input "2020-02-02" in the "dob" box
    And I click "Create!"
    Then I see "blue cat"
    And I see "2020-02-02"

  Scenario: Create a red dog
    Given I am on the page "/Animal/create"
    When I input "red dog" in the "name" box
    And I input "2020-02-01" in the "dob" box
    And I click "Create!"
    Then I see "red dog"
    And I see "2020-02-01"
