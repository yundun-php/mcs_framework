<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Logger\Cases;

use YundunMcs\Logger\Log;
use YundunMcs\Logger\Levels;
use PHPUnit\Framework\TestCase;
use YundunMcs\Util\Contracts\Arrayable;

class LogTest extends TestCase
{
    protected function createLog(int $level = Levels::DEBUG, string $message = 'test', array $context = [])
    {
        return new Log($level, $message, $context);
    }

    public function testLogInstanceOfArrayable()
    {
        $log = $this->createLog();

        $this->assertInstanceOf(Arrayable::class, $log);
    }

    public function testLogGetLevel()
    {
        $log = $this->createLog(Levels::ALERT);

        $this->assertEquals(Levels::ALERT, $log->getLevel());
    }

    public function testLogGetLevelName()
    {
        $log = $this->createLog(Levels::ALERT);

        $this->assertEquals(Levels::getLevelName(Levels::ALERT), $log->getLevelName());
    }

    public function testLogGetMessage()
    {
        $log = $this->createLog(Levels::ALERT, 'foo');

        $this->assertEquals('foo', $log->getMessage());
    }

    public function testLogGetContext()
    {
        $log = $this->createLog(Levels::DEBUG, 'test', ['foo' => 'foo']);

        $this->assertEquals(['foo' => 'foo'], $log->getContext());
    }

    public function testLogGetTimestamp()
    {
        $now = time();
        $log = $this->createLog();

        $this->assertGreaterThanOrEqual($now, $log->getTimestamp());
    }

    public function testLogGetDatetime()
    {
        $log       = $this->createLog();
        $timestamp = $log->getTimestamp();

        $this->assertEquals(date('Y-m-d H:i:s', $timestamp), $log->getDatetime());
        $this->assertEquals(date('Y-m-d', $timestamp), $log->getDatetime('Y-m-d'));
    }

    public function testLogArrayable()
    {
        $log = $this->createLog();

        $this->assertEquals(
            [
                'level'     => $log->getLevel(),
                'levelName' => $log->getLevelName(),
                'message'   => $log->getMessage(),
                'timestamp' => $log->getTimestamp(),
                'context'   => $log->getContext(),
            ],
            $log->toArray()
        );
    }
}
