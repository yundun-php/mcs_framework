<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Database\Mocks;

use YundunMcs\Database\MySQL\Arguments;
use YundunMcs\Database\MySQL\Grammars\StatementContainer;
use YundunMcs\Database\MySQL\Grammars\AbstractGrammar;

class TestGrammar extends AbstractGrammar
{
    public function compile(): StatementContainer
    {
        return new StatementContainer();
    }
}
