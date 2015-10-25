Feature: Check API response
  In order to validate the response
  As a user
  I need to be able to validate the data in the response

  @regression
  Scenario: Check the response headers for Categories by Customer endpoint
    When I query "/service/hello/carli"
    And The response status code is "200"
    And The response data is
    """
    {"data":"Hello carli!"}
    """

  Scenario: Check the response headers for Categories by Customer endpoint
    When I query "/service/hello/horacio"
    And The response status code is "200"
    And The response data is
    """
    {"data":"Hello horacio!"}
    """