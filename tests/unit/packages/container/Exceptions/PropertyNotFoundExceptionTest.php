<?php

namespace Redfox\Container\Tests\Unit\Exceptions;

use PHPUnit\Framework\TestCase;
use Redfox\Container\Exceptions\BadPropertyCallException;
use Redfox\Container\Exceptions\PropertyNotFoundException;

class PropertyNotFoundExceptionTest extends TestCase
{
    /**
     * Test.
     */
    public function testBecausePropertyNotExists()
    {
        $e = PropertyNotFoundException::becausePropertyNotFound('fooBar');

        $this->assertInstanceOf(PropertyNotFoundException::class, $e);
        $this->assertInstanceOf(BadPropertyCallException::class, $e);
        $this->assertInstanceOf(\LogicException::class, $e);
        $this->assertEquals('The designated property "fooBar" could not be found!', $e->getMessage());
    }
}
