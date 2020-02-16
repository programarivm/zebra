<?php

namespace App\Tests\Unit\Bundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoremIpsumTest extends WebTestCase
{
    private static $knpUIpsum;

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        self::$container = $kernel->getContainer();

        self::$knpUIpsum = self::$container->get('knpu_lorem_ipsum.knpu_ipsum');
    }

    /**
     * @test
     */
    public function one_word()
    {
        $word = self::$knpUIpsum->getWords(1);

        $this->assertIsString($word);
    }
}
