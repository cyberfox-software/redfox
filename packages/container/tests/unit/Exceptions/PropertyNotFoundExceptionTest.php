<?php

namespace Redfox\Container\Tests\Unit\Exceptions;

use Redfox\Container\Exceptions\BadPropertyCallException;
use Redfox\Container\Exceptions\PropertyNotFoundException;

class PropertyNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
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
