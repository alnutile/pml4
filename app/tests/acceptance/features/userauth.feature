Feature: Test Login
  Scenario: I visit dashboard should end up at login
    Given I am on "/dashboard"
    Then I should see "You need to login to visit that page."
    And the url should match "/login"
    And I fill in "Username or Email" with "admin"
    And I fill in "password" with "admin"
    And I press "Login"
    Then the url should match "/dashboard"