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

        self::$easyAcl = self::$container->get('programarivm_easy_acl.lorem_ipsum');
    }

    /**
     * @test
     */
    public function one_word()
    {
        $word = self::$easyAcl->getWords(1);

        $this->assertIsString($word);
    }
}
