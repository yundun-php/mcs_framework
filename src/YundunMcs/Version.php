<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs;

class Version
{
    /**
     * The version of the current YundunMcs framework.
     */
    const VERSION = '1.0.0-dev';

    /**
     * Get the version of the current YundunMcs framework.
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return self::VERSION;
    }
}
