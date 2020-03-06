<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Container\Cases;

use stdClass;
use YundunMcs\Container\Wrapper;
use PHPUnit\Framework\TestCase;
use YundunMcs\Util\Contracts\Wrapper as WrapperContract;

class WrapperTest extends TestCase
{
    public function testWrapperInstanceOfWrapperContract()
    {
        $wrapper = new Wrapper('test');

        $this->assertInstanceOf(WrapperContract::class, $wrapper);
    }

    public function testWrapperGetSource()
    {
        $wrapper = new Wrapper('test');
        $this->assertEquals('test', $wrapper->getOriginal());

        $obj     = new stdClass();
        $hash    = spl_object_hash($obj);
        $wrapper = new Wrapper($obj);
        $this->assertEquals($obj, $wrapper->getOriginal());
        $this->assertEquals($hash, spl_object_hash($wrapper->getOriginal()));
    }
}
