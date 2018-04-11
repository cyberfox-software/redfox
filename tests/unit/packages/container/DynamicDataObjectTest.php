<?php

namespace Redfox\Container\Tests\Unit\Support;

use PHPUnit\Framework\TestCase;
use Redfox\Container\DynamicDataObject;
use Redfox\Container\Contracts\DataObjectInterface;

class DynamicDataObjectTest extends TestCase
{
    /**
     * Test.
     */
    public function testImplementingDataObjectInterface()
    {
        $obj = new DynamicDataObject();

        $this->assertInstanceOf(DataObjectInterface::class, $obj);
    }

    /**
     * Test.
     */
    public function testDynamicGetter()
    {
        /** @var DynamicDataObject|\PHPUnit_Framework_MockObject_MockObject $obj */
        $obj = $this->getMockBuilder(DynamicDataObject::class)
            ->disableOriginalConstructor()
            ->setMethods(['getProperty'])
            ->getMock();

        $obj->expects($this->once())
            ->method('getProperty')
            ->with('myProperty', null)
            ->willReturn('foo-bar');

        $this->assertEquals('foo-bar', $obj->myProperty);
    }

    /**
     * Test.
     */
    public function testDynamicSetter()
    {
        /** @var DynamicDataObject|\PHPUnit_Framework_MockObject_MockObject $obj */
        $obj = $this->getMockBuilder(DynamicDataObject::class)
            ->disableOriginalConstructor()
            ->setMethods(['setProperty'])
            ->getMock();

        $obj->expects($this->once())
            ->method('setProperty')
            ->with('myProperty', 'foo-bar');

        $obj->myProperty = 'foo-bar';
    }
}
