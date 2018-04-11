<?php

namespace Redfox\Container\Tests\Unit\Exceptions;

use PHPUnit\Framework\TestCase;
use Redfox\Container\Exceptions\BadPropertyCallException;

class BadPropertyExceptionTest extends TestCase
{
    /**
     * Test.
     */
    public function testBecausePropertyNotExists()
    {
        $e = BadPropertyCallException::becausePropertyNotExists('fooBar');

        $this->assertInstanceOf(BadPropertyCallException::class, $e);
        $this->assertInstanceOf(\LogicException::class, $e);
        $this->assertEquals('The designated property "fooBar" does not exist or is not accessible!', $e->getMessage());
    }
}
