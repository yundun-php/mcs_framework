<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Database\Cases\MySQL\Grammars\Traits;

use YundunMcs\Container\Wrapper;
use PHPUnit\Framework\TestCase;
use YundunMcs\Database\MySQL\Grammars\Filter;
use YundunMcs\Database\MySQL\Grammars\WhereFilterWrapper;
use YundunMcsTests\Database\Mocks\TestWhereGrammarFoundationSupport;

class WhereGrammarFoundationSupportTest extends TestCase
{
    protected function createTestWhereGrammarFoundationSupport()
    {
        return new TestWhereGrammarFoundationSupport();
    }

    public function testWhereGrammarFoundationSupportHasWhereFilter()
    {
        $support = $this->createTestWhereGrammarFoundationSupport();

        $this->assertFalse($support->hasWhereFilter());
        $support->getWhereFilter();
        $this->assertFalse($support->hasWhereFilter());
        $support->getWhereFilter()->addColumnFilter('foo', 'foo');
        $this->assertTrue($support->hasWhereFilter());
    }

    public function testWhereGrammarFoundationSupportCreateWhereFilterWrapper()
    {
        $support = $this->createTestWhereGrammarFoundationSupport();

        $this->assertInstanceOf(Wrapper::class, $support->createWhereFilterWrapper('and'));
        $this->assertInstanceOf(WhereFilterWrapper::class, $support->createWhereFilterWrapper('and'));
    }

    public function testWhereGrammarFoundationSupportGetWhereFilter()
    {
        $support = $this->createTestWhereGrammarFoundationSupport();

        $this->assertInstanceOf(Filter::class, $support->getWhereFilter());
    }
}
