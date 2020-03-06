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

class Server extends Collection
{
    /**
     * Create server and execution environment variables collection.
     *
     * @param iterable $server Server and execution environment variables.
     *
     * @return self
     */
    public static function create(iterable $server): self
    {
        return new static($server);
    }
}
