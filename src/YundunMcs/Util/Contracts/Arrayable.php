<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Util\Contracts;

interface Arrayable
{
    /**
     * Returns the current object as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
