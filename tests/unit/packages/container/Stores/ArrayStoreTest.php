<?php

namespace Redfox\Tests\Unit\Stores;

use PHPUnit\Framework\TestCase;
use Redfox\Container\Stores\ArrayStore;

class ArrayCollectionTest extends TestCase
{
    /**
     * Test.
     */
    public function testConstructor()
    {
        $store = new ArrayStore();
        $this->assertAttributeEmpty('data', $store);
        $this->assertAttributeEquals([], 'data', $store);
    }

    /**
     * Test.
     */
    public function testMethodSet()
    {
        $store = new ArrayStore();

        $expected = ['foo' => 'Bar'];
        $store->set('foo', 'Bar');
        $this->assertAttributeEquals($expected, 'data', $store);

        $store->set('bar.foo.another.key', 'jjjKKLL123');
        $expected = [
            'foo' => 'Bar',
            'bar' => [
                'foo' => [
                    'another' => [
                        'key' => 'jjjKKLL123',
                    ],
                ],
            ],
        ];
        $this->assertAttributeEquals($expected, 'data', $store);

        return $store;
    }

    /**
     * Test.
     */
    public function testMethodGet()
    {
        $store = new ArrayStore();

        $store->set('foo', 'Bar');
        $this->assertEquals('Bar', $store->get('foo'));

        $data = [
            'foo' => [
                'another' => [
                    'key' => 'jjjKKLL123',
                ],
            ],
        ];
        $store->set('bar', $data);
        $this->assertEquals('jjjKKLL123', $store->get('bar.foo.another.key'));
    }

    /**
     * Test.
     */
    public function testMethodGetUsingDefault()
    {
        $store = new ArrayStore();
        $this->assertNull($store->get('foo'));

        $this->assertEquals('Bar', $store->get('foo', 'Bar'));
    }

    /**
     * Test.
     */
    public function testMethodRemove()
    {
        $store = new ArrayStore();
        $store->set('foo', 'Bar');
        $store->set('one.two.three', 123);

        $expected = [
            'foo' => 'Bar',
            'one' => [
                'two' => [
                    'three' => 123,
                ],
            ],
        ];
        $this->assertAttributeEquals($expected, 'data', $store);

        $store->remove('foo');
        unset($expected['foo']);
        $this->assertAttributeEquals($expected, 'data', $store);
        $this->assertNull($store->get('foo'));

        $store->remove('one.two');
        unset($expected['one']['two']);
        $this->assertAttributeEquals($expected, 'data', $store);
        $this->assertNull($store->get('one.two'));

        $this->assertEquals([], $store->get('one'));
    }

    /**
     * Test.
     */
    public function testMethodExists()
    {
        $store = new ArrayStore();
        $this->assertFalse($store->exists('foo'));
        $this->assertFalse($store->exists('one.two.three'));

        $store->set('myKey', 25.33);
        $this->assertTrue($store->exists('myKey'));
    }

    /**
     * Test.
     */
    public function testMethodHas()
    {
        $store = new ArrayStore();
        $this->assertFalse($store->has('foo'));
        $this->assertFalse($store->has('one.two.three'));

        $store->set('myKey', null);
        $this->assertFalse($store->has('myKey'));
        $store->set('myKey', 33);
        $this->assertTrue($store->has('myKey'));
    }

    /**
     * Test.
     *
     * @depends testMethodSet
     */
    public function testMethodFlush(ArrayStore $store)
    {
        $store->flush();
        $this->assertAttributeEmpty('data', $store);
    }

    /**
     * Test.
     */
    public function testMethodRemember()
    {
        $store = new ArrayStore();

        $expected = ['foo' => 'Bar'];
        $store->set('foo', 'Bar');
        $this->assertAttributeEquals($expected, 'data', $store);

        $store->remember('foo', function () {
            return 7567;
        });
        $this->assertAttributeEquals($expected, 'data', $store);
        $this->assertEquals('Bar', $store->get('foo'));

        $expected = ['foo' => 'Bar', 'myKey' => 7567];
        $store->remember('myKey', function () {
            return 7567;
        });
        $this->assertAttributeEquals($expected, 'data', $store);
        $this->assertEquals(7567, $store->get('myKey'));
    }
}
