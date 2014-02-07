Feature: Comment

  Background: Log in
    Given I am on "logout"
    Given I am on "login"
    And I fill in "Username or Email" with "admin"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait


  Scenario: Create Comment
    Given I am on "/projects/2/issues/44"
    Then I should see "New Comment"
    And I follow "New Comment"
    And I wait for "1" seconds
    And I fill in "Description" with:
    """
       At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
    """
    And I press "Create Comment"
    And I wait for "2" seconds
    Then I should see "Comment Created "
    Then I should see "Emails sent "
    Then I should see "Emailed alfrednutile@gmail.com"
    Then I should see "Emails Failed none"
    Then I should see "Failed Emails are none"