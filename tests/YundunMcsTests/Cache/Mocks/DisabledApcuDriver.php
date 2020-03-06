<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Cache\Mocks;

use YundunMcs\Cache\Drivers\ApcuDriver;

class DisabledApcuDriver extends ApcuDriver
{
    public static function isEnabled(): bool
    {
        return false;
    }
}
