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
use YundunMcs\Http\Server\Globals\Query;
use YundunMcs\Http\Foundation\Collection;

class QueryTest extends TestCase
{
    public function testQueryCollection()
    {
        $query = new Query();

        $this->assertInstanceOf(Collection::class, $query);
    }

    public function testQueryCreate()
    {
        $query = Query::create(['test' => 'test']);

        $this->assertInstanceOf(Collection::class, $query);
        $this->assertEquals(['test' => 'test'], $query->toArray());
    }
}
