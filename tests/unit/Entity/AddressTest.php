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
    public function validate()
    {
        $validator = Validation::createValidatorBuilder()
                        ->addYamlMapping('config/validator/validation.yaml')
                        ->getValidator();

        $errors = (new Address())->validate($validator);

        $expected = [
            'This value should not be blank.',
        ];

        $this->assertEquals($expected, $errors);
    }
}
