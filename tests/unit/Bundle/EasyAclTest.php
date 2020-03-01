<?php

namespace App\Tests\Unit\Bundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EasyAclTest extends WebTestCase
{
    private static $easyAcl;

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        self::$container = $kernel->getContainer();

        self::$easyAcl = self::$container->get('programarivm.easy_acl');
    }

    /**
     * @test
     */
    public function signal()
    {
        $expected = 'Hello world! Name: 51 Pegasi c. Exoplanet: true. Satellites: 10.';

        $this->assertEquals($expected, self::$easyAcl->signal());
    }
}
