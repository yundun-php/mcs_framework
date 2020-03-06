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
use YundunMcs\Http\Foundation\Collection;
use YundunMcs\Http\Server\Globals\Cookies;

class CookiesTest extends TestCase
{
    public function testCookiesExtendsCollection()
    {
        $cookies = new Cookies();

        $this->assertInstanceOf(Collection::class, $cookies);
    }

    public function testCookiesCreate()
    {
        $cookies = Cookies::create(['test' => 'test']);

        $this->assertInstanceOf(Collection::class, $cookies);
        $this->assertEquals(['test' => 'test'], $cookies->toArray());
    }
}
