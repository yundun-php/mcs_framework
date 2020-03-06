<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Event\Cases;

use YundunMcs\Event\Event;
use YundunMcs\Event\Dispatcher;
use YundunMcs\Container\Wrapper;
use PHPUnit\Framework\TestCase;
use YundunMcs\Event\CallableListener;
use YundunMcs\Event\Contracts\Listener;

class CallableListenerTest extends TestCase
{
    public function testCallableListenerExtendsWrapper()
    {
        $listener = new CallableListener(function () {});

        $this->assertInstanceOf(Wrapper::class, $listener);
    }

    public function testCallableListenerInstanceOfListener()
    {
        $listener = new CallableListener(function () {});

        $this->assertInstanceOf(Listener::class, $listener);
    }

    public function testCallableListenerHandle()
    {
        $event      = new Event('test');
        $dispatcher = new Dispatcher();
        $listener   = new CallableListener(
            function ($listenerEvent, $listenerDispatcher) use ($event, $dispatcher) {
                $this->assertInstanceOf(Event::class, $listenerEvent);
                $this->assertInstanceOf(Dispatcher::class, $listenerDispatcher);
                $this->assertEquals($event, $listenerEvent);
                $this->assertEquals($dispatcher, $listenerDispatcher);
            }
        );

        $listener->handle($event, $dispatcher);
    }
}
