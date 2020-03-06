<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Database\MySQL\Grammars\Traits;

use YundunMcs\Container\Wrapper;
use YundunMcs\Database\MySQL\Grammars\Filter;
use YundunMcs\Database\MySQL\Grammars\WhereFilterWrapper;

trait WhereGrammarFoundationSupport
{
    /**
     * The where filter wrapper instance.
     *
     * @var YundunMcs\Database\MySQL\Grammars\WhereFilterWrapper|null
     */
    protected $whereFilterWrapper = null;

    /**
     * Determine if the where filter exists.
     *
     * @return bool
     */
    public function hasWhereFilter(): bool
    {
        if (is_null($this->whereFilterWrapper)) {
            return false;
        }

        return !$this->whereFilterWrapper->getOriginal()->isEmpty();
    }

    /**
     * Create a where filter wrapper instance.
     *
     * @param string $connector The default filter connector.
     *
     * @return YundunMcs\Container\Wrapper
     */
    public function createWhereFilterWrapper(string $connector): Wrapper
    {
        return new WhereFilterWrapper($connector);
    }

    /**
     * Get the where filter instance.
     *
     * @return YundunMcs\Database\MySQL\Grammars\Filter
     */
    public function getWhereFilter(): Filter
    {
        if (is_null($this->whereFilterWrapper)) {
            $this->whereFilterWrapper = $this->createWhereFilterWrapper('and');
        }

        return $this->whereFilterWrapper->getOriginal();
    }
}
