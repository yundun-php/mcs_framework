<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Event\Cases;

use YundunMcs\Event\Collector;
use YundunMcs\Event\Dispatcher;
use PHPUnit\Framework\TestCase;
use YundunMcs\Event\DispatcherContainer;
use YundunMcs\Event\Traits\CollectorSupport;
use YundunMcsTests\Event\Mocks\TestListener;
use YundunMcs\Event\Contracts\Collector as CollectorContract;

class CollectorTest extends TestCase
{
    public function testCollectorUseTraitCollectorSupport()
    {
        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher);
        $uses       = class_uses($collector);

        $this->assertArrayHasKey(CollectorSupport::class, $uses);
        $this->assertEquals(CollectorSupport::class, $uses[CollectorSupport::class]);
    }

    public function testCollectorExtendsDispatcherContainer()
    {
        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher);

        $this->assertInstanceOf(DispatcherContainer::class, $collector);
    }

    public function testCollectorInstanceOfCollectorContract()
    {
        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher);

        $this->assertInstanceOf(CollectorContract::class, $collector);
    }

    public function testCollectorGetEventDispatcher()
    {
        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher);

        $this->assertInstanceOf(Dispatcher::class, $collector->getEventDispatcher());
        $this->assertEquals($dispatcher, $collector->getEventDispatcher());
    }

    public function testCollectorGetSubcomponentEventName()
    {
        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher);

        $this->assertEquals('', $collector->getSubcomponentEventName());

        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher, 'foo');

        $this->assertEquals('foo', $collector->getSubcomponentEventName());
    }

    public function testCollectorOn()
    {
        $listener   = new TestListener();
        $dispatcher = new Dispatcher();
        $collector  = new Collector($dispatcher);

        $this->assertEquals($collector, $collector->on('test', $listener));
        $this->assertEquals([$listener], $dispatcher->getListeners('test'));
    }
}
