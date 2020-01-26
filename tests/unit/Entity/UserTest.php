<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function validate_falsy()
    {
        $validator = Validation::createValidatorBuilder()
                        ->addYamlMapping('config/validator/validation.yaml')
                        ->getValidator();

        $errors = (new User())->validate($validator);

        $expected = [
            "The user's username cannot be empty.",
            "The user's email cannot be empty.",
            "The user's password cannot be empty.",
        ];

        $this->assertEquals($expected, $errors);
    }
}
