<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Logger\Contracts;

use YundunMcs\Logger\Log;

interface Formatter
{
    /**
     * Format the contents of the log.
     *
     * @param string            $channel The logger channel name.
     * @param YundunMcs\Logger\Log $log     The log body instance.
     *
     * @return string
     */
    public function format(string $channel, Log $log): string;
}
