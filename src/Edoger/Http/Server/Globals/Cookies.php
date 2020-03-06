<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Http\Server\Globals;

use Edoger\Http\Foundation\Collection;

class Cookies extends Collection
{
    /**
     * Create request cookies collection.
     *
     * @param iterable $server  The request cookies.
     * @param iterable $cookies
     *
     * @return self
     */
    public static function create(iterable $cookies): self
    {
        return new static($cookies);
    }
}
