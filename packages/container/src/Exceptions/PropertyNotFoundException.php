<?php
/*
 * ----------------------------------------------------------------------------
 * This file is part of the Redfox PHP Framework
 * and is subject to the MIT license that is bundled with this source code.
 *
 * @copyright (c) 2017 Cyberfox Software Solutions e.U.
 * ----------------------------------------------------------------------------
 */

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
