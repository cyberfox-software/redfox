<?php

namespace Redfox\Tests\Unit\Collections;

use Redfox\Container\Collections\ArrayCollection;

class ArrayCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $testData = [];

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->testData = [
            'foo' => 'BAR',
            'Awesome' => true,
            100 => 'one hundred',
            'date' => date('Y-m-d H:i:s'),
            'values' => [rand(10, 99), rand(1000, 9999)],
        ];
    }

    /**
     * Test.
     */
    public function testConstructor()
    {
        $collection = new ArrayCollection($this->testData);
        $this->assertAttributeEquals($this->testData, 'data', $collection);
    }

    /**
     * Test.
     */
    public function testFactoryMethod()
    {
        $collection = ArrayCollection::create();
        $this->assertInstanceOf(ArrayCollection::class, $collection);
        $this->assertAttributeEmpty('data', $collection);
        $this->assertAttributeEquals([], 'data', $collection);

        $collection = ArrayCollection::create($this->testData);
        $this->assertInstanceOf(ArrayCollection::class, $collection);
        $this->assertAttributeEquals($this->testData, 'data', $collection);
    }

    /**
     * Test.
     */
    public function testImplementationArrayAccessOffsetExists()
    {
        $collection = new ArrayCollection($this->testData);
        $this->assertTrue($collection->offsetExists('foo'));
        $this->assertTrue($collection->offsetExists('Awesome'));
        $this->assertTrue($collection->offsetExists(100));
        $this->assertTrue($collection->offsetExists('date'));
        $this->assertTrue($collection->offsetExists('values'));

        $this->assertFalse($collection->offsetExists('does_not_exist'));
        $this->assertFalse($collection->offsetExists(rand(1, 999)));
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     */
    public function testImplementationArrayAccessOffsetExistsThrowsInvalidArgumentException($invalid)
    {
        $collection = new ArrayCollection($this->testData);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $collection->offsetExists($invalid);
    }

    /**
     * Test.
     */
    public function testImplementationArrayAccessOffsetGet()
    {
        $collection = new ArrayCollection($this->testData);
        $this->assertEquals($this->testData['foo'], $collection->offsetGet('foo'));
        $this->assertEquals($this->testData['Awesome'], $collection->offsetGet('Awesome'));
        $this->assertEquals($this->testData[100], $collection->offsetGet(100));
        $this->assertEquals($this->testData['date'], $collection->offsetGet('date'));
        $this->assertEquals($this->testData['values'], $collection->offsetGet('values'));

        $this->assertNull($collection->offsetGet('does_not_exist'));
        $this->assertNull($collection->offsetGet(rand(1, 999)));
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     * @param mixed $invalid
     */
    public function testImplementationArrayAccessOffsetGetThrowsInvalidArgumentException($invalid)
    {
        $collection = new ArrayCollection($this->testData);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $collection->offsetGet($invalid);
    }

    /**
     * Test.
     */
    public function testImplementationArrayAccessOffsetSet()
    {
        $collection = new ArrayCollection($this->testData);

        $this->testData['foo'] = 'no bar';
        $collection->offsetSet('foo', 'no bar');
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        $this->testData['Awesome'] = false;
        $collection->offsetSet('Awesome', false);
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        $this->testData[100] = 100;
        $collection->offsetSet(100, 100);
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        $this->testData['date'] = null;
        $collection->offsetSet('date', null);
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        $this->testData['values'] = [];
        $collection->offsetSet('values', []);
        $this->assertAttributeEquals($this->testData, 'data', $collection);
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     * @param mixed $invalid
     */
    public function testImplementationArrayAccessOffsetSetThrowsInvalidArgumentException($invalid)
    {
        $collection = new ArrayCollection($this->testData);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $collection->offsetSet($invalid, '');
    }

    /**
     * Test.
     */
    public function testImplementationArrayAccessOffsetUnset()
    {
        $collection = new ArrayCollection($this->testData);

        unset($this->testData['foo']);
        $collection->offsetUnset('foo');
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        unset($this->testData['Awesome']);
        $collection->offsetUnset('Awesome');
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        unset($this->testData[100]);
        $collection->offsetUnset(100);
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        unset($this->testData['date']);
        $collection->offsetUnset('date');
        $this->assertAttributeEquals($this->testData, 'data', $collection);

        unset($this->testData['values']);
        $collection->offsetUnset('values');
        $this->assertAttributeEquals($this->testData, 'data', $collection);
    }

    /**
     * Test.
     *
     * @dataProvider getInvalidOffsetCollection
     * @param mixed $invalid
     */
    public function testImplementationArrayAccessOffsetUnsetThrowsInvalidArgumentException($invalid)
    {
        $collection = new ArrayCollection($this->testData);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The offset should be either a string or an integer!');

        $collection->offsetUnset($invalid);
    }

    /**
     * Test.
     */
    public function testImplementationIteratorCurrent()
    {
        $collection = new ArrayCollection($this->testData);

        $this->assertEquals(current($this->testData), $collection->current());
    }

    /**
     * Test.
     */
    public function testImplementationIteratorNext()
    {
        $collection = new ArrayCollection($this->testData);

        $this->assertEquals(current($this->testData), $collection->current());
        next($this->testData);
        $collection->next();
        $this->assertEquals(current($this->testData), $collection->current());

        next($this->testData);
        $collection->next();
        $this->assertEquals(current($this->testData), $collection->current());
    }

    /**
     * Test.
     */
    public function testImplementationIteratorKey()
    {
        $collection = new ArrayCollection($this->testData);

        $this->assertEquals(key($this->testData), $collection->key());
        next($this->testData);
        $collection->next();
        $this->assertEquals(key($this->testData), $collection->key());

        next($this->testData);
        $collection->next();
        $this->assertEquals(key($this->testData), $collection->key());
    }

    /**
     * Test.
     */
    public function testImplementationIteratorValid()
    {
        /** @var ArrayCollection|\PHPUnit_Framework_MockObject_MockObject $collection */
        $collection = $this->getMockBuilder(ArrayCollection::class)
            ->setConstructorArgs([ $this->testData ])
            ->setMethods(['offsetExists', 'key'])
            ->getMock();

        $testKey = 'fooBar';
        $collection->expects($this->once())
            ->method('key')
            ->willReturn($testKey);

        $collection->expects($this->once())
            ->method('offsetExists')
            ->with($testKey)
            ->willReturn('barFoo');

        $this->assertEquals('barFoo', $collection->valid());
    }

    /**
     * Test.
     */
    public function testImplementationIteratorRewind()
    {
        $collection = new ArrayCollection($this->testData);

        $collection->next();
        $collection->next();
        $this->assertNotEquals(key($this->testData), $collection->key());
        $this->assertNotEquals(current($this->testData), $collection->current());

        $collection->rewind();
        $this->assertEquals(key($this->testData), $collection->key());
        $this->assertEquals(current($this->testData), $collection->current());
    }

    /**
     * Test.
     */
    public function testImplementationCountableCount()
    {
        $collection = new ArrayCollection($this->testData);

        $this->assertEquals(count($this->testData), $collection->count());
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
