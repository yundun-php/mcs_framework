<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Database\MySQL\Grammars;

use YundunMcs\Util\Arr;
use YundunMcs\Util\Contracts\Arrayable;
use YundunMcs\Database\MySQL\Exceptions\GrammarException;

class Fragments implements Arrayable
{
    /**
     * The SQL statement fragments.
     *
     * @var array
     */
    protected $fragments = [];

    /**
     * The SQL statement fragments constructor.
     *
     * @param mixed $fragments The SQL statement fragments.
     *
     * @throws YundunMcs\Database\MySQL\Exceptions\GrammarException Thrown when the statement fragment is invalid.
     *
     * @return void
     */
    public function __construct($fragments = [])
    {
        foreach (Arr::convert($fragments) as $fragment) {
            if (is_string($fragment)) {
                $this->push($fragment);
            } else {
                throw new GrammarException('Invalid statement fragment.');
            }
        }
    }

    /**
     * Create a statement fragment manager instance.
     *
     * @param mixed $fragments The SQL statement fragments.
     *
     * @return self
     */
    public static function create($fragments = []): self
    {
        return new static($fragments);
    }

    /**
     * Determines whether the current statement fragment collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->fragments);
    }

    /**
     * Append a SQL statement fragment.
     *
     * @param string $fragment The given statement fragment.
     *
     * @return self
     */
    public function push(string $fragment): self
    {
        $this->fragments[] = $fragment;

        return $this;
    }

    /**
     * Remove a SQL statement fragment.
     *
     * @return string
     */
    public function pop(): string
    {
        if ($this->isEmpty()) {
            return '';
        }

        return array_shift($this->fragments);
    }

    /**
     * Clear all SQL statement fragments.
     *
     * @return self
     */
    public function clear(): self
    {
        $this->fragments = [];

        return $this;
    }

    /**
     * Assemble all current statement fragments into a complete statement.
     *
     * @return string
     */
    public function assemble(): string
    {
        return implode(' ', $this->fragments);
    }

    /**
     * Returns the current fragments instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->fragments;
    }
}
