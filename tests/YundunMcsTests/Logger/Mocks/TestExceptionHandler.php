<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Logger\Mocks;

use Closure;
use Exception;
use YundunMcs\Logger\Log;
use YundunMcs\Logger\AbstractHandler;

class TestExceptionHandler extends AbstractHandler
{
    public function handle(string $channel, Log $log, Closure $next): bool
    {
        throw new Exception('ExceptionHandler');
    }
}
