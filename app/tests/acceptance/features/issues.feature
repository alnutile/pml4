Feature: Issues Crud

  Background: Log in
    Given I am on "logout"
    Given I am on "login"
    And I fill in "Username or Email" with "admin"
    And I fill in "password" with "admin"
    And I press "Login"

  @issues
  Scenario: And I create and issue and see error
    Given I am on "/dashboard"
    And I follow "Test 2"
    And I follow "Create Issue"
    And I wait
    And I press "Create Issue"
    Then I should see "The name field is required."