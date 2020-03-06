<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Logger\Cases;

use Exception;
use YundunMcs\Logger\Blocker;
use YundunMcs\Container\Container;
use PHPUnit\Framework\TestCase;
use YundunMcs\Flow\Contracts\Blocker as BlockerContract;

class BlockerTest extends TestCase
{
    protected function createBlocker()
    {
        return new Blocker();
    }

    public function testBlockerInstanceOfBlockerContract()
    {
        $blocker = $this->createBlocker();

        $this->assertInstanceOf(BlockerContract::class, $blocker);
    }

    public function testBlockerBlock()
    {
        $blocker   = $this->createBlocker();
        $container = new Container();

        $this->assertTrue($blocker->block($container, true));
        $this->assertFalse($blocker->block($container, false));
    }

    public function testBlockerComplete()
    {
        $blocker   = $this->createBlocker();
        $container = new Container();

        $this->assertTrue($blocker->complete($container));
    }

    public function testBlockerError()
    {
        $blocker   = $this->createBlocker();
        $container = new Container();
        $exception = new Exception('test');

        $this->assertFalse($blocker->error($container, $exception));
    }
}
