<?php
// phpcs:ignoreFile

class ProcessTest extends TestCase
{
    /**
     * Test for a request with with the correct parameter.
     *
     * @return void
     */
    public function testRequestWithCorrectParameter()
    {
        $response = $this->call('GET', '/api/process/information');

        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'information',
                'execution_time',
                'results'
            ]
        );
    }

    /**
     * Test for a request with no parameter.
     *
     * @return void
     */
    public function testRequestWithNoParameter()
    {
        $response = $this->call('GET', '/api/process/');

        $this->seeStatusCode(404);
    }
}
