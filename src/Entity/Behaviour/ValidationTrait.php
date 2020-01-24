<?php

namespace App\Entity\Behaviour;

use Symfony\Component\Validator\Validation;

trait ValidationTrait
{
    /**
     * Validates an entity with the rules definied in validation.yml
     *
     * @param   Symfony\Component\Validator\Validation $service
     * @return  null|array An array of error messages, otherwise null.
     */
    public function validate(Validation $service)
    {
        $messages = [];
        $errors = $service->validate($this);
        foreach($errors as $error) {
            $messages[] = $error->getMessage();
        }

        return $messages;
    }
}
