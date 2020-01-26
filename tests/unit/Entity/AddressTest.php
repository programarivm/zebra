<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Address;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AddressTest extends TestCase
{
    /**
     * @test
     */
    public function validate_falsy()
    {
        $validator = Validation::createValidatorBuilder()
                        ->addYamlMapping('config/validator/validation.yaml')
                        ->getValidator();

        $errors = (new Address())->validate($validator);

        $expected = [
            "The address cannot be empty.",
            "The address's postcode cannot be empty.",
            "The address's city cannot be empty.",
            "The address's user cannot be empty.",
        ];

        $this->assertEquals($expected, $errors);
    }
}
