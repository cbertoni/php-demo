<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientErrorResponseException;

/**
 * REST context.
 */
class RestContext implements Context
{
    private $base_url;
    private $rest;

    /**
     * Initializes context.
     */
    public function __construct($base_url)
    {
        $this->base_url = $base_url;
        $this->rest     = new Client(
            ['base_url' => $base_url]
        );
    }

    /**
     * @When I query :resource
     */
    public function iQuery($resource)
    {        
        try {
            $request              = $this->rest->createRequest('GET', $resource, []);
            $response             = $this->rest->send($request);
            $this->full_response  = $response;
        } catch (ClientErrorResponseException $e) {
            $this->full_response = $e->getResponse();
        }
    }

    /**
     * @Then The response data is
     */
    public function theResponseDataIs(PyStringNode $multiline_value)
    {
        $string_data = (string) $multiline_value;
        $json_data = json_encode(json_decode($string_data));
        $response_json = json_encode($this->full_response->json());
        $this->compare($json_data, $response_json);
    }

    /**
     * @Then The response status code is :status_code
     */
    public function theResponseStatusCodeIs($status_code)
    {
        $this->compare(intval($status_code), $this->full_response->getStatusCode());
    }

    private function compare($expected, $current) {
        if($expected !== $current) {
            throw new Exception(
                sprintf(
                    "Expected:\n%s\nCurrent:\n%s",
                    json_encode($expected),
                    json_encode($current)
                )
            );
        }
    }
}
