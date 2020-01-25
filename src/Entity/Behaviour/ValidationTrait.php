<?php

namespace App\Entity\Behaviour;

trait ValidationTrait
{
    /**
     * Validates an entity with the rules definied in config/validator/validation.yml
     *
     * @param $service
     * @return null|array An array of error messages, otherwise null.
     */
    public function validate($service)
    {
        $messages = [];
        $errors = $service->validate($this);
        foreach($errors as $error) {
            $messages[] = $error->getMessage();
        }

        return $messages;
    }
}
