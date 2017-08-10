<?php

namespace Redfox\Container\Tests\Unit\Support;

use Redfox\Container\Exceptions\BadPropertyCallException;
use Redfox\Container\Tests\Unit\Mocks\AccessorMock;

class AccessorTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test.
     */
    public function testGetterThrowsException()
    {
        $obj = new AccessorMock();

        $this->expectException(BadPropertyCallException::class);
        $this->expectExceptionMessage('The designated property "unknown" does not exist or is not accessible!');

        $obj->unknown;
    }

    /**
     * Test.
     */
    public function testGetterCallingProtectedMethod()
    {
        /** @var AccessorMock|\PHPUnit_Framework_MockObject_MockObject $obj */
        $obj = $this->getMockBuilder(AccessorMock::class)->setMethods(['getPropertyFoo'])->getMock();

        $obj->expects($this->once())
            ->method('getPropertyFoo')
            ->willReturn('bar');

        $this->assertEquals('bar', $obj->foo);
    }

    /**
     * Test.
     */
    public function testSetterThrowsException()
    {
        $obj = new AccessorMock();

        $this->expectException(BadPropertyCallException::class);
        $this->expectExceptionMessage('The designated property "unknown" does not exist or is not accessible!');

        $obj->unknown = false;
    }

    /**
     * Test.
     */
    public function testSetterCallingProtectedMethod()
    {
        /** @var AccessorMock|\PHPUnit_Framework_MockObject_MockObject $obj */
        $obj = $this->getMockBuilder(AccessorMock::class)->setMethods(['setPropertyFoo'])->getMock();

        $obj->expects($this->once())
            ->method('setPropertyFoo')
            ->with('Bar');

        $obj->foo = 'Bar';
    }
}
