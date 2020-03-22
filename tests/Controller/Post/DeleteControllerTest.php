<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function index()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/posts/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
