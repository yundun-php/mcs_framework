<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Database\MySQL\Grammars;

use YundunMcs\Database\MySQL\Arguments;
use YundunMcs\Database\MySQL\Grammars\Traits\LimitGrammarSupport;
use YundunMcs\Database\MySQL\Grammars\Traits\WhereGrammarSupport;
use YundunMcs\Database\MySQL\Grammars\Traits\WhereGrammarFoundationSupport;

class DeleteGrammar extends AbstractGrammar
{
    use WhereGrammarFoundationSupport, WhereGrammarSupport, LimitGrammarSupport;

    /**
     * Compile the current SQL statement.
     *
     * @return YundunMcs\Database\MySQL\Grammars\StatementContainer
     */
    public function compile(): StatementContainer
    {
        $arguments = Arguments::create();
        $fragments = Fragments::create(['DELETE FROM', $this->getWrappedFullTableName()]);

        if ($this->hasWhereFilter()) {
            $fragments->push('WHERE '.$this->getWhereFilter()->compile($arguments));
        }

        if ($this->hasLimit()) {
            $fragments->push('LIMIT '.$this->getLimit());
        }

        $container = new StatementContainer([
            Statement::create($fragments->assemble(), $arguments),
        ]);

        return $container;
    }
}
