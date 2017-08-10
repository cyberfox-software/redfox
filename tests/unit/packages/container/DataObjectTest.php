<?php

namespace Redfox\Container\Tests\Unit\Support;

use Redfox\Container\DataObject;
use Redfox\Container\Contracts\DataObjectInterface;
use Redfox\Container\Exceptions\BadPropertyCallException;
use Redfox\Container\StrictDataObject;

class DataObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var string
     */
    private $propertyValue;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->propertyName = 'myDynamicProperty' . date('Ymd_His');
        $this->propertyValue = rand(10, 99) . '-' . md5($this->propertyName) . '-' . rand(100, 999);
    }

    /**
     * Test.
     */
    public function testImplementingDataObjectInterface()
    {
        $obj = new DataObject();

        $this->assertInstanceOf(DataObjectInterface::class, $obj);
    }

    /**
     * Test.
     */
    public function testConstructor()
    {
        $data = [
            $this->propertyName => $this->propertyValue,
            'foo' => 'bar',
            'isset' => true,
        ];
        $obj = new DataObject($data);
        $this->assertAttributeEquals($data, 'data', $obj);
    }

    /**
     * Test.
     */
    public function testSetProperty()
    {
        $obj = new DataObject();

        $return = $obj->setProperty($this->propertyName, $this->propertyValue);
        $this->assertEquals($obj, $return);

        $data = [$this->propertyName => $this->propertyValue];
        $this->assertAttributeEquals($data, 'data', $obj);

        $obj->setProperty('foo', 'bar');
        $data['foo'] = 'bar';
        $this->assertAttributeEquals($data, 'data', $obj);

        $obj->setProperty(123, 25.6);
        $data[123] = 25.6;
        $this->assertAttributeEquals($data, 'data', $obj);

        $obj->setProperty('emp', null);
        $data['emp'] = null;
        $this->assertAttributeEquals($data, 'data', $obj);
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     * @param mixed $invalid
     */
    public function testSetPropertyThrowsInvalidArgumentException($invalid)
    {
        $obj = new DataObject();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $obj->setProperty($invalid, '');
    }

    /**
     * Test.
     */
    public function testGetProperty()
    {
        $obj = new DataObject();
        $obj->setProperty($this->propertyName, $this->propertyValue);

        $this->assertEquals($this->propertyValue, $obj->getProperty($this->propertyName));
    }

    /**
     * Test.
     */
    public function testGetPropertyReturnFallbackValueOnEmptyProperty()
    {
        $obj = new DataObject();
        $obj->setProperty($this->propertyName, null);

        $this->assertAttributeEquals([$this->propertyName => null], 'data', $obj);
        $this->assertEquals('default', $obj->getProperty($this->propertyName, 'default'));
    }

    /**
     * Test.
     */
    public function testGetPropertyReturnFallbackValueWhenPropertyIsNotSet()
    {
        $obj = new DataObject();

        $this->assertNull($obj->getProperty($this->propertyName));
    }

    /**
     * Test.
     */
    public function testGetPropertyReturnNullWhenPropertyIsNotSet()
    {
        $obj = new DataObject();

        $this->assertEquals('default', $obj->getProperty($this->propertyName, 'default'));
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     * @param mixed $invalid
     */
    public function testGetPropertyThrowsInvalidArgumentException($invalid)
    {
        $obj = new DataObject();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $obj->getProperty($invalid);
    }

    /**
     * Test.
     */
    public function testIsPropertySet()
    {
        $obj = new DataObject();
        $this->assertFalse($obj->isPropertySet('unknown'));

        $obj->setProperty('foo', 'Bar');
        $this->assertTrue($obj->isPropertySet('foo'));
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     * @param mixed $invalid
     */
    public function testIsPropertySetThrowsInvalidArgumentException($invalid)
    {
        $obj = new DataObject();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $obj->getProperty($invalid);
    }

    /**
     * Test.
     */
    public function testFlush()
    {
        $obj = new DataObject();
        $obj->setProperty($this->propertyName, $this->propertyValue);

        $return = $obj->flush();
        $this->assertAttributeEquals([], 'data', $obj);
        $this->assertEquals($obj, $return);
    }

    /**
     * Test.
     */
    public function testGetRawData()
    {
        $testData = ['foo' => 'Bar', 'Awesome' => true];
        $obj = new DataObject(['foo' => 'Bar', 'Awesome' => true]);

        $this->assertEquals($testData, $obj->getRawData());
    }

    /**
     * Test.
     */
    public function testGetPropertyThrowsBadPropertyCallException()
    {
        $obj = new StrictDataObject();

        $this->expectException(BadPropertyCallException::class);
        $this->expectExceptionMessage('The designated property "unknown" does not exist or is not accessible!');

        $obj->getProperty('unknown');
    }

    /**
     * Test.
     */
    public function testSetPropertyThrowsBadPropertyCallException()
    {
        $obj = new StrictDataObject();

        $this->expectException(BadPropertyCallException::class);
        $this->expectExceptionMessage('The designated property "unknown" does not exist or is not accessible!');

        $obj->setProperty('unknown', null);
    }

    /**
     * @return array
     */
    public function getInvalidOffsetCollection()
    {
        return [
            [ [] ],
            [ null ],
            [ (object)['foo' => 'bar'] ],
            [ 23.45 ],
        ];
    }
}
