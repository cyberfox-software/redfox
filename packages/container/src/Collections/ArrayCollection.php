<?php

namespace Redfox\Container\Collections;

use Redfox\Container\Support\ValidatesOffsetTrait;

class ArrayCollection implements \ArrayAccess, \Iterator, \Countable
{
    use ValidatesOffsetTrait;

    /**
     * the raw data collection
     *
     * @var array
     */
    protected $data = [];

    /**
     * Factory
     *
     * Usage:
     * ```php
     * $collection = ArrayCollection::create(['foo' => 'bar', 'awesome' => true]);
     * ```
     *
     * @param array|null $data
     *
     * @return static
     */
    public static function create(array $data = [])
    {
        return new static($data);
    }

    /**
     * ArrayCollection constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string|integer $offset
     * @return bool
     * @throws \InvalidArgumentException if the designated offset is invalid
     */
    public function offsetExists($offset)
    {
        $this->validateOffset($offset);

        return array_key_exists($offset, $this->data);
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param string|integer $offset
     * @return mixed
     * @throws \InvalidArgumentException if the designated offset is invalid
     */
    public function offsetGet($offset)
    {
        $this->validateOffset($offset);

        return array_key_exists($offset, $this->data) ? $this->data[$offset] : null;
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param string|integer $offset
     * @param mixed $value
     * @throws \InvalidArgumentException if the designated offset is invalid
     */
    public function offsetSet($offset, $value)
    {
        $this->validateOffset($offset);

        $this->data[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param string|integer $offset
     * @throws \InvalidArgumentException if the designated offset is invalid
     *
     */
    public function offsetUnset($offset)
    {
        $this->validateOffset($offset);

        if (isset($this->data[$offset])) {
            unset($this->data[$offset]);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/iterator.current.php
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/iterator.next.php
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/iterator.key.php
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/iterator.valid.php
     */
    public function valid()
    {
        return $this->offsetExists($this->key());
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/iterator.rewind.php
     */
    public function rewind()
    {
        reset($this->data);
    }

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/countable.count.php
     */
    public function count()
    {
        return count($this->data);
    }
}
