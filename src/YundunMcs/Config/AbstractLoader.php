<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Config;

use Closure;
use YundunMcs\Flow\EmptyProcessor;

abstract class AbstractLoader extends EmptyProcessor
{
    /**
     * Load the configuration group.
     *
     * @param string  $group  The configuration group name.
     * @param bool    $reload Whether to reload the configuration group.
     * @param Closure $next   The trigger for the next loader.
     *
     * @return YundunMcs\Config\Repository
     */
    abstract public function load(string $group, bool $reload, Closure $next): Repository;
}
