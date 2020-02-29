<?php

namespace App\Tests\Unit\Bundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloWorldTest extends WebTestCase
{
    private static $helloWorld;

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        self::$container = $kernel->getContainer();

        self::$helloWorld = self::$container->get('programarivm.hello_world');
    }

    /**
     * @test
     */
    public function signal()
    {
        $expected = 'Hello world! Name: 51 Pegasi c. Exoplanet: true. Satellites: 10.';

        $this->assertEquals($expected, self::$helloWorld->signal());
    }
}
