<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Config\Mocks;

use Closure;
use Exception;
use YundunMcs\Config\Repository;
use YundunMcs\Config\AbstractLoader;

class TestExceptionLoader extends AbstractLoader
{
    public function load(string $group, bool $reload, Closure $next): Repository
    {
        throw new Exception($group);
    }
}
