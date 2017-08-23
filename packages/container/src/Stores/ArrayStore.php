<?php

namespace Redfox\Container\Stores;

use Redfox\Container\Contracts\StoreInterface;

class ArrayStore implements StoreInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value = null)
    {
        $current = &$this->data;
        foreach (explode('.', $key) as $key) {
            if (!array_key_exists($key, $current) || !is_array($current[$key])) {
                $current[$key] = [];
            }

            $current = &$current[$key];
        }

        $current = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        $current = &$this->data;
        foreach (explode('.', $key) as $key) {
            if (!array_key_exists($key, $current)) {
                return $default;
            }

            $current = &$current[$key];
        }

        return $current;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $key)
    {
        $current = &$this->data;
        $parent = &$current;
        foreach (explode('.', $key) as $key) {
            if (!array_key_exists($key, $current)) {
                return;
            }

            $parent = &$current;
            $current = &$current[$key];
        }

        unset($parent[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $key): bool
    {
        $current = &$this->data;
        foreach (explode('.', $key) as $key) {
            if (!array_key_exists($key, $current)) {
                return false;
            }

            $current = &$current[$key];
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return $this->exists($key) && $this->get($key) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function remember(string $key, callable $default)
    {
        if (!$this->exists($key)) {
            $value = call_user_func($default);
            $this->set($key, $value);
        }

        return $this->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->data = [];
    }
}
