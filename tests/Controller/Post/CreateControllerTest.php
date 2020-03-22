<?php

namespace App\Tests\Controller\Post;

use App\Tests\Controller\AccessTokenTestCase;

class CreateControllerTest extends AccessTokenTestCase
{
    /**
     * @test
     */
    public function index()
    {
        $client = static::createClient();

        $client->request('POST', '/api/posts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
