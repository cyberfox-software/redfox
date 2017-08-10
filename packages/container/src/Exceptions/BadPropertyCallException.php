<?php

namespace Redfox\Container\Exceptions;

class BadPropertyCallException extends \LogicException
{
    /**
     * @param string $propertyName
     *
     * @return static
     */
    public static function becausePropertyNotExists($propertyName)
    {
        return new static('The designated property "' . $propertyName . '" does not exist or is not accessible!');
    }
}
