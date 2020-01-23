<?php

namespace App\Entity\Behaviour;

trait VerbosityTrait
{
    /**
     * Sets the entity's properties.
     *
     * @param array $props
     * @return $this
     */
    public function setProps(array $props)
    {
        foreach($props as $key => $val) {
            $method = 'set'.$this->camelize($key);
            if (method_exists($this, $method)) {
                $this->{$method}($this->filter($key, $val));
            }
        }

        return $this;
    }

    /**
     * Camelizes a string.
     *
     * @param string $string
     * @param string $separator
     * @return $this
     */
    private function camelize(string $string, string $separator = '_')
    {
        return str_replace($separator, '', ucwords($string, $separator));
    }

    /**
     * Applies a filter.
     *
     * @param string $key
     * @param mixed $val
     */
    private function filter(string $key, $val)
    {
        switch (true) {
            case empty($val):
                return null;
            case substr($key, 0, 3) === 'is_':
                return filter_var($val, FILTER_VALIDATE_BOOLEAN);
            case is_string($val) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $val):
                return new \DateTime($val);
            default:
                return $val;
        }
    }
}
