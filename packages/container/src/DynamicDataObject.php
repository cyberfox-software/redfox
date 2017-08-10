<?php

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
    function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * @see \Redfox\Container\DataObject::setProperty()
     *
     * @param string $name
     * @param mixed $value
     */
    function __set($name, $value)
    {
        $this->setProperty($name, $value);
    }
}
