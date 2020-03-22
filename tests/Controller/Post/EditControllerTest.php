<?php

namespace App\Tests\Controller\Post;

use App\Tests\Controller\AccessTokenTestCase;

class EditControllerTest extends AccessTokenTestCase
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
