<?php

namespace Redfox\Container\Contracts;

interface DataObjectInterface
{
    /**
     * @param string     $name
     * @param mixed|null $fallbackValue
     *
     * @return mixed|null
     */
    public function getProperty($name, $fallbackValue = null);

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return static
     */
    public function setProperty($name, $value);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isPropertySet($name);

    /**
     * @return static
     */
    public function flush();

    /**
     * Get the raw data array
     *
     * @return array
     */
    public function getRawData();
}
