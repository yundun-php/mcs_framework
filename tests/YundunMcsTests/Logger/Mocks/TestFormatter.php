<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Logger\Mocks;

use YundunMcs\Logger\Log;
use YundunMcs\Logger\Contracts\Formatter;

class TestFormatter implements Formatter
{
    public function format(string $channel, Log $log): string
    {
        return 'TEST::'.$channel.$log->getMessage();
    }
}
