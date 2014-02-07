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
    And I fill in "Name" with "Test Issue Behat"
    And I fill in "Description" with:
    """
       At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
    """
    And I check "Active"
    And I press "Create Issue"
    Then I should see "Issue Created"
    Then I should see "Emails sent "
    Then I should see "Emailed alfrednutile@gmail.com"
    Then I should see "Emails Failed none"
    Then I should see "Failed Emails are none"

