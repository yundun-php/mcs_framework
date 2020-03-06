<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Container\Cases;

use IteratorAggregate;
use YundunMcs\Container\Container;
use PHPUnit\Framework\TestCase;
use YundunMcs\Container\Collection;

class CollectionTest extends TestCase
{
    public function testCollectionInstanceOfIteratorAggregate()
    {
        $this->assertInstanceOf(IteratorAggregate::class, new Collection());
    }

    public function testCollectionExtendsContainer()
    {
        $this->assertInstanceOf(Container::class, new Collection());
    }

    public function testCollectionSet()
    {
        $collection = new Collection();

        $collection->set('foo', 'foo');
        $this->assertEquals('foo', $collection->get('foo'));

        $collection->set('foo', 1);
        $this->assertEquals(1, $collection->get('foo'));
    }

    public function testCollectionDelete()
    {
        $collection = new Collection(['foo' => 'foo']);

        $this->assertTrue($collection->has('foo'));
        $collection->delete('foo');
        $this->assertFalse($collection->has('foo'));
    }

    public function testCollectionClear()
    {
        $collection = new Collection(['foo' => 'foo']);

        $this->assertEquals(['foo' => 'foo'], $collection->toArray());
        $this->assertEquals($collection, $collection->clear());
        $this->assertEquals([], $collection->toArray());
    }

    public function testCollectionIteratorAggregate()
    {
        $elements   = ['foo' => 'foo', 'bar' => 'bar'];
        $collection = new Collection($elements);

        foreach ($collection as $key => $value) {
            $this->assertEquals($elements[$key], $value);
        }
    }
}
