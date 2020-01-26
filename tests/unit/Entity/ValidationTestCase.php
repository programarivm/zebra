<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ValidationTestCase extends TestCase
{
    protected static $validator;

    public static function setUpBeforeClass()
    {
        self::$validator = Validation::createValidatorBuilder()
                                ->addYamlMapping('config/validator/validation.yaml')
                                ->getValidator();
    }
}
