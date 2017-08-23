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

use Redfox\Container\Support\ValidatesOffsetTrait;
use Redfox\Container\Contracts\DataObjectInterface;
use Redfox\Container\Exceptions\BadPropertyCallException;

class DataObject implements DataObjectInterface
{
    use ValidatesOffsetTrait;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Use this switch to en- or disable the strict mode.
     * If strict mode on only pre defined data could be used as properties.
     * So you can prevent using the object as a dynamic data container.
     *
     * @var bool
     */
    protected $strict = false;

    /**
     * DataObject constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException                             if the designated property name is not valid
     * @throws \Redfox\Container\Exceptions\BadPropertyCallException if strict mode is on and the designated property does not exist or is not accessible
     */
    public function getProperty($name, $fallbackValue = null)
    {
        $this->validateOffset($name);

        if (!$this->isPropertySet($name)) {
            if ($this->strict === true) {
                throw BadPropertyCallException::becausePropertyNotExists($name);
            }

            return $fallbackValue;
        }

        return $this->data[$name] !== null ? $this->data[$name] : $fallbackValue;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException                             if the designated property name is not valid
     * @throws \Redfox\Container\Exceptions\BadPropertyCallException if strict mode is on and the designated property does not exist or is not accessible
     */
    public function setProperty($name, $value)
    {
        $this->validateOffset($name);

        if ($this->strict === true && !$this->isPropertySet($name)) {
            throw BadPropertyCallException::becausePropertyNotExists($name);
        }

        $this->data[$name] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPropertySet($name)
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->data = [];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRawData()
    {
        return $this->data;
    }
}
