<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function api_post_show()
    {
        $client = static::createClient();

        $client->request('GET', '/api/posts/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function api_post_edit()
    {
        $client = static::createClient();

        $client->request('PUT', '/api/posts/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
