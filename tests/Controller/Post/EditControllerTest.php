<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function index()
    {
        $client = static::createClient();

        $client->request('PUT', '/api/posts/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
