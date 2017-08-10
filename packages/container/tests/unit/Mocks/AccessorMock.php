<?php

namespace Redfox\Container\Tests\Unit\Mocks;

use Redfox\Container\Support\AccessorTrait;

/**
 * Class AccessorMock
 *
 * @property string $foo
 */
class AccessorMock
{
    use AccessorTrait;

    /**
     * @return string
     */
    protected function getPropertyFoo()
    {
        return 'BAR';
    }

    /**
     * @param string $value
     */
    protected function setPropertyFoo($value)
    {
        return;
    }

}
