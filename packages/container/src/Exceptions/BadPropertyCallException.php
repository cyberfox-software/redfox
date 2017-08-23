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
