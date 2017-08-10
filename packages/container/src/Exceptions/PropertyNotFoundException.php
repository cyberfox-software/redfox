<?php

namespace Redfox\Container\Exceptions;

class PropertyNotFoundException extends BadPropertyCallException
{
    /**
     * @param string $propertyName
     *
     * @return static
     */
    public static function becausePropertyNotFound($propertyName)
    {
        return new static('The designated property "' . $propertyName . '" could not be found!');
    }
}
