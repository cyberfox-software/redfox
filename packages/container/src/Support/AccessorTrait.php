<?php
/*
 * ----------------------------------------------------------------------------
 * This file is part of the Redfox PHP Framework
 * and is subject to the MIT license that is bundled with this source code.
 *
 * @copyright (c) 2017 Cyberfox Software Solutions e.U.
 * ----------------------------------------------------------------------------
 */

namespace Redfox\Container\Support;

use Redfox\Container\Exceptions\BadPropertyCallException;

trait AccessorTrait
{
    /**
     * {@inheritdoc}
     *
     * @param string $name
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function __get($name)
    {
        $methodName = 'getProperty' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->{$methodName}();
        }

        throw BadPropertyCallException::becausePropertyNotExists($name);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function __set($name, $value)
    {
        $methodName = 'setProperty' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->{$methodName}($value);
        }

        throw BadPropertyCallException::becausePropertyNotExists($name);
    }
}
