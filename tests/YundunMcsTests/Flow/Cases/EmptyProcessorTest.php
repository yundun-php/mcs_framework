<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Flow\Cases;

use YundunMcs\Flow\Flow;
use YundunMcs\Flow\EmptyProcessor;
use PHPUnit\Framework\TestCase;
use YundunMcs\Flow\Contracts\Processor;
use YundunMcsTests\Flow\Mocks\TestBlocker;
use YundunMcs\Flow\Traits\EmptyProcessorSupport;

class EmptyProcessorTest extends TestCase
{
    public function createEmptyProcessor()
    {
        return new EmptyProcessor();
    }

    public function testEmptyProcessorInstanceOfProcessor()
    {
        $processor = $this->createEmptyProcessor();

        $this->assertInstanceOf(Processor::class, $processor);
    }

    public function testEmptyProcessorUseTraitEmptyProcessorSupport()
    {
        $uses     = class_uses($this->createEmptyProcessor());
        $abstract = EmptyProcessorSupport::class;

        $this->assertArrayHasKey($abstract, $uses);
        $this->assertEquals($abstract, $uses[$abstract]);
    }

    public function testEmptyProcessor()
    {
        $flow = new Flow(new TestBlocker());

        $flow->append($this->createEmptyProcessor());

        $this->assertEquals(['complete', [], null], $flow->start());
    }
}
