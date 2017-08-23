<?php
/*
 * ----------------------------------------------------------------------------
 * This file is part of the Redfox PHP Framework
 * and is subject to the MIT license that is bundled with this source code.
 *
 * @copyright (c) 2017 Cyberfox Software Solutions e.U.
 * ----------------------------------------------------------------------------
 */

namespace Redfox\Container;

use Redfox\Container\Contracts\DataObjectInterface;

class DynamicDataObject extends DataObject implements DataObjectInterface
{
    /**
     * @see \Redfox\Container\DataObject::getProperty()
     *
     * @param string $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * @see \Redfox\Container\DataObject::setProperty()
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->setProperty($name, $value);
    }
}
