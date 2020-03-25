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
        self::$client->request('POST', '/api/posts');

        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
    }
}
