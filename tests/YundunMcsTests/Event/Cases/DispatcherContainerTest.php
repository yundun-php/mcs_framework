<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Event\Cases;

use YundunMcs\Event\Dispatcher;
use PHPUnit\Framework\TestCase;
use YundunMcs\Event\DispatcherContainer;
use YundunMcs\Event\Contracts\DispatcherContainer as DispatcherContainerContract;

class DispatcherContainerTest extends TestCase
{
    public function testDispatcherContainerInstanceOfDispatcherContainerContract()
    {
        $dispatcher = new Dispatcher();
        $container  = new DispatcherContainer($dispatcher);

        $this->assertInstanceOf(DispatcherContainerContract::class, $container);
    }

    public function testDispatcherContainerGetEventDispatcher()
    {
        $dispatcher = new Dispatcher();
        $container  = new DispatcherContainer($dispatcher);

        $this->assertInstanceOf(Dispatcher::class, $container->getEventDispatcher());
        $this->assertEquals($dispatcher, $container->getEventDispatcher());
    }

    public function testDispatcherContainerGetSubcomponentEventName()
    {
        $dispatcher = new Dispatcher();
        $container  = new DispatcherContainer($dispatcher);

        $this->assertEquals('', $container->getSubcomponentEventName());

        $dispatcher = new Dispatcher();
        $container  = new DispatcherContainer($dispatcher, 'foo');

        $this->assertEquals('foo', $container->getSubcomponentEventName());
    }
}
