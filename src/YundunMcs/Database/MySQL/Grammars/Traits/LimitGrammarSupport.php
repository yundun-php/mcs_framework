<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Database\MySQL\Grammars\Traits;

use YundunMcs\Util\Validator;
use YundunMcs\Database\MySQL\Exceptions\GrammarException;

trait LimitGrammarSupport
{
    /**
     * The limit value.
     *
     * @var int
     */
    protected $limited = 0;

    /**
     * Set the limit value.
     *
     * @param int $limit The limit value.
     *
     * @throws YundunMcs\Database\MySQL\Exceptions\GrammarException Thrown when the limit is invalid.
     *
     * @return self
     */
    public function limit(int $limit)
    {
        if (Validator::isNegativeInteger($limit)) {
            throw new GrammarException('The limit value can not be less than 0.');
        }

        $this->limited = $limit;

        return $this;
    }

    /**
     * Determine whether there is a limit value.
     *
     * @return bool
     */
    public function hasLimit(): bool
    {
        return 0 < $this->limited;
    }

    /**
     * Get the limit value.
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limited;
    }
}
