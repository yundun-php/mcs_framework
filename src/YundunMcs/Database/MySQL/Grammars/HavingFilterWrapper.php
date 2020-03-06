<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Database\MySQL\Grammars;

use YundunMcs\Container\Wrapper;
use YundunMcs\Database\MySQL\Grammars\Traits\HavingGrammarSupport;

class HavingFilterWrapper extends Wrapper
{
    use HavingGrammarSupport;

    /**
     * The having filter wrapper constructor.
     *
     * @param string $connector The default filter connector.
     * 
     * @return void
     */
    public function __construct(string $connector)
    {
        parent::__construct(new Filter($connector));
    }

    /**
     * Create a having filter wrapper instance.
     *
     * @param string $connector The default filter connector.
     *
     * @return YundunMcs\Container\Wrapper
     */
    public function createHavingFilterWrapper(string $connector): Wrapper
    {
        return new static($connector);
    }

    /**
     * Get the having filter instance.
     *
     * @return YundunMcs\Database\MySQL\Grammars\Filter
     */
    public function getHavingFilter(): Filter
    {
        return $this->getOriginal();
    }
}
