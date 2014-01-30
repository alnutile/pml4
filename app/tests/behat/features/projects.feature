Feature: Projects Crud

  Background: Log in
    Given I am on "logout"
    Given I am on "login"
    And I fill in "Username or Email" with "admin"
    And I fill in "password" with "admin"
    And I press "Login"

  Scenario: Create Project
    Given I am on "/dashboard"
    And I wait for "2" seconds
    And I follow "Create Project"
    And I fill in "Name" with "Test Behat"
    And I fill in "Description" with:
      """
       At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
      """
    And I select "user@example.org" from "people"
    And I press "Create Project"
    Then I should see "Project Created Test Behat"
