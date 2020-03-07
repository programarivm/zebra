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
    public function roles()
    {
        $expected = [
            [
                'hierarchy' => 0,
                'name' => 'Superadmin',
            ],
            [
                'hierarchy' => 1,
                'name' => 'Admin',
            ],
            [
                'hierarchy' => 2,
                'name' => 'Basic',
            ],
        ];

        $this->assertEquals($expected, self::$easyAcl->getRoles());
    }
}
