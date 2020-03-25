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
        self::$client->request('PUT', '/api/posts/1');

        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
    }
}
