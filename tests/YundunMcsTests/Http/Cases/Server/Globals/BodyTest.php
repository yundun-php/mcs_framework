<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Http\Cases\Server\Globals;

use PHPUnit\Framework\TestCase;
use YundunMcs\Http\Server\Globals\Body;
use YundunMcs\Http\Foundation\Collection;

class BodyTest extends TestCase
{
    public function testBodyExtendsCollection()
    {
        $body = new Body();

        $this->assertInstanceOf(Collection::class, $body);
    }

    public function testBodyCreate()
    {
        $body = Body::create(['test' => 'test']);

        $this->assertInstanceOf(Collection::class, $body);
        $this->assertEquals(['test' => 'test'], $body->toArray());
    }
}
