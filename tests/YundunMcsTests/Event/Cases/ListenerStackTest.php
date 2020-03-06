<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Event\Cases;

use YundunMcs\Container\Stack;
use YundunMcs\Event\ListenerStack;
use PHPUnit\Framework\TestCase;

class ListenerStackTest extends TestCase
{
    public function testListenerStackExtendsStack()
    {
        $stack = new ListenerStack();

        $this->assertInstanceOf(Stack::class, $stack);
    }

    public function testListenerStackIsEnabled()
    {
        $stack = new ListenerStack();

        $this->assertTrue($stack->isEnabled());
    }

    public function testListenerStackEnable()
    {
        $stack = new ListenerStack();

        $this->assertEquals($stack, $stack->enable());
        $this->assertTrue($stack->isEnabled());
    }

    public function testListenerStackDisable()
    {
        $stack = new ListenerStack();

        $this->assertEquals($stack, $stack->disable());
        $this->assertFalse($stack->isEnabled());
    }
}
