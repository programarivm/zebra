<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Tests\Unit\Entity\ValidationTestCase;

class UserTest extends ValidationTestCase
{
    /**
     * @test
     */
    public function validate_falsy()
    {
        $errors = (new User())->validate(self::$validator);

        $expected = [
            "The user's username cannot be empty.",
            "The user's email cannot be empty.",
        ];

        $this->assertEquals($expected, $errors);
    }

    /**
     * @test
     */
    public function validate_bob()
    {
        $props = [
            'username' => 'bob',
            'email' => 'bob',
        ];

        $errors = (new User())
                    ->setProps($props)
                    ->validate(self::$validator);

        $expected = [
            "The user's email is not a valid one.",
        ];

        $this->assertEquals($expected, $errors);
    }
}
