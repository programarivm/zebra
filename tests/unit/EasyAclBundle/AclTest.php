<?php

namespace App\Tests\Unit\EasyAclBundle;

use PHPUnit\Framework\TestCase;
use Programarivm\EasyAclBundle\Acl;

class AclTest extends TestCase
{
    /**
     * @test
     */
    public function foo()
    {
        $expected = 'foo';

        $this->assertEquals($expected, (new Acl())->foo());
    }
}
