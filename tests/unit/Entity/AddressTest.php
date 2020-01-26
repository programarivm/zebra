<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Address;
use App\Tests\Unit\Entity\ValidationTestCase;

class AddressTest extends ValidationTestCase
{
    /**
     * @test
     */
    public function validate_falsy()
    {
        $errors = (new Address())->validate(self::$validator);

        $expected = [
            "The address cannot be empty.",
            "The address's postcode cannot be empty.",
            "The address's city cannot be empty.",
            "The address's user cannot be empty.",
        ];

        $this->assertEquals($expected, $errors);
    }
}
