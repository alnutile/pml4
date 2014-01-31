Feature: Projects Crud

  Background: Log in
    Given I am on "logout"
    Given I am on "login"
    And I fill in "Username or Email" with "admin"
    And I fill in "password" with "admin"
    And I press "Login"

  Scenario: Create Project
    Given I am on "/dashboard"
    And I follow "Create Project"
    And I fill in "Name" with "Test Behat"
    And I fill in "Description" with:
    """
       At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
      """
    And I select "admin@example.org" from "people"
    And I press "Create Project"
    Then I should see "Project Created Test Behat"

  Scenario: Projects Show page
    Given I am on "/dashboard"
    And I follow "Test 2"
    Then I should see "Test 4"
    Then I should see "Edit Project"
    Then I should see "Create Issue"

  Scenario: Projects Edit page
    Given I am on "/dashboard"
    And I follow "Test 2"
    Then I follow "Edit Project"
    Then I should not see "edit.blade"