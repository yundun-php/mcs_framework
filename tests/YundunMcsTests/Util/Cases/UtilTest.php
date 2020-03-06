<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Util\Cases;

use YundunMcs\Util\Util;
use PHPUnit\Framework\TestCase;
use YundunMcsTests\Util\Mocks\TestWrapper;

class UtilTest extends TestCase
{
    public function testUtilValue()
    {
        $this->assertEquals('foo', Util::value('foo'));
        $this->assertEquals('foo', Util::value(new TestWrapper('foo')));
        $this->assertEquals('foo', Util::value(function () {
            return 'foo';
        }));
    }
}
