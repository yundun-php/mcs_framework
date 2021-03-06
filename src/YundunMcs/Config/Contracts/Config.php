<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Config\Contracts;

use YundunMcs\Config\Repository;

interface Config
{
    /**
     * Gets the configuration group collection for the given name.
     * If the configuration group does not exist, an empty collection is returned.
     *
     * @param string $group  The configuration group name.
     * @param bool   $reload Whether to reload the configuration group.
     *
     * @return YundunMcs\Config\Repository
     */
    public function group(string $group, bool $reload = false): Repository;
}
