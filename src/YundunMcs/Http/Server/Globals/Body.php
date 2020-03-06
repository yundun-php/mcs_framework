<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Http\Server\Globals;

use YundunMcs\Http\Foundation\Collection;

class Body extends Collection
{
    /**
     * Create request body parameters collection.
     *
     * @param iterable $server The request body parameters.
     * @param iterable $body
     *
     * @return self
     */
    public static function create(iterable $body): self
    {
        return new static($body);
    }
}
