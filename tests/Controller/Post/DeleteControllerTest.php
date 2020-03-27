<?php

namespace App\Tests\Controller\Post;

use App\Tests\Controller\AccessTokenTestCase;

class DeleteControllerTest extends AccessTokenTestCase
{
    /**
     * @test
     */
    public function index()
    {
        self::$client->request(
            'DELETE',
            '/api/posts/1',
            [],
            [],
            [
                'HTTP_AUTHORIZATION' => 'Bearer '.self::$accessToken,
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode([])
        );

        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
    }
}
