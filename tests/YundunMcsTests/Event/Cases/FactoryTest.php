<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Event\Cases;

use YundunMcs\Event\Factory;
use YundunMcs\Event\Dispatcher;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testFactoryCreateDispatcher()
    {
        $dispatcher = Factory::createDispatcher();
        $this->assertInstanceOf(Dispatcher::class, $dispatcher);
        $this->assertEquals('', $dispatcher->getEventGroupName());

        $dispatcher = Factory::createDispatcher('test');
        $this->assertInstanceOf(Dispatcher::class, $dispatcher);
        $this->assertEquals('test', $dispatcher->getEventGroupName());
    }

    public function testFactoryCreateYundunMcsDispatcher()
    {
        $dispatcher = Factory::createYundunMcsDispatcher();
        $this->assertInstanceOf(Dispatcher::class, $dispatcher);
        $this->assertEquals('edoger', $dispatcher->getEventGroupName());

        $dispatcher = Factory::createYundunMcsDispatcher('test');
        $this->assertInstanceOf(Dispatcher::class, $dispatcher);
        $this->assertEquals('edoger.test', $dispatcher->getEventGroupName());
    }
}
