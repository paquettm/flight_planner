Feature: login
  In order to access functionality reserved to authenticated users
  As a person on the internet
  I need to be able to login

  Scenario: try logging in correctly
    Given I have registered an account for username "Tarzan", with password "Jane"
    When I log in with username "Tarzan" and password "Jane"
    Then I see "main page"

  Scenario: try logging in incorrectly
    Given I have registered an account for username "Tarzan", with password "Jane"
    When I log in with username "Tarzan" and password "Jane!"
    Then I see "Incorrect username/password combination!"