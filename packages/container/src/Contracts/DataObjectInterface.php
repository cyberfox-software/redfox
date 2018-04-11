<?php
/*
 * ----------------------------------------------------------------------------
 * This file is part of the Redfox PHP Framework
 * and is subject to the MIT license that is bundled with this source code.
 *
 * @copyright (c) 2017 Cyberfox Software Solutions e.U.
 * ----------------------------------------------------------------------------
 */

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
    public function isPropertySet($name): bool;

    /**
     * @return static
     */
    public function flush();

    /**
     * Get the raw data array.
     *
     * @return array
     */
    public function getRawData(): array;
}
