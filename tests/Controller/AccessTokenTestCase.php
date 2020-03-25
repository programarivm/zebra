<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AccessTokenTestCase extends WebTestCase
{
    protected static $accessToken;

    protected static $client;

    public function setUp()
    {
        $user = [
            'username' => 'alice',
            'password' => 'password',
        ];

        self::$client = static::createClient();

        self::$client->request(
            'POST',
            '/api/auth',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($user)
        );

        $content = json_decode(self::$client->getResponse()->getContent());

        self::$accessToken = $content->access_token;
    }
}
