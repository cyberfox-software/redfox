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

interface StoreInterface
{
    /**
     * Set an item to the store.
     *
     * The storage key is supporting the usage of "dot" notation.
     * Example of an "dot" notation:
     * ```
     * [
     *    'key1' => [
     *      'key2' => 'value',
     *    ],
     * ]
     * ```
     *    is equal to
     * ```
     * key1.key2 = 'value'
     * ```
     *
     * @param string $keysupporting the usage of "dot" notation.
     * @param mixed  $value
     *
     * @return void
     */
    public function set(string $key, $value = null);

    /**
     * Get an item from the store.
     *
     * The storage key is supporting the usage of "dot" notation.
     *
     * @param string     $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    public function get(string $key, $default = null);

    /**
     * Remove an item from the store.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function remove(string $key);

    /**
     * Checks if the designated key/item exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * Checks if the designated key/item exists and is not null.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Get an item from the store. If the item is not available, the return value of the callback will be stored
     * and returned.
     *
     * @param string   $key
     * @param callable $default
     *
     * @return mixed
     */
    public function remember(string $key, callable $default);

    /**
     * Removes all items from the store.
     *
     * @return void
     */
    public function flush();
}
