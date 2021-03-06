<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Logger;

use Throwable;
use YundunMcs\Container\Container;
use YundunMcs\Flow\Contracts\Blocker as BlockerContract;

class Blocker implements BlockerContract
{
    /**
     * The log handle flow blocker constructor.
     *
     * @return void
     */
    public function __construct()
    {
        // do nothing
    }

    /**
     * Handle the flow block event.
     *
     * @param YundunMcs\Container\Container $input  The processor input parameter container.
     * @param bool                       $result The processor flow return value.
     *
     * @return bool
     */
    public function block(Container $input, $result)
    {
        return $result;
    }

    /**
     * Handle the flow complete event.
     *
     * @param YundunMcs\Container\Container $input The processor input parameter container.
     *
     * @return bool
     */
    public function complete(Container $input)
    {
        return true;
    }

    /**
     * Handle the flow error event.
     *
     * @param YundunMcs\Container\Container $input     The processor input parameter container.
     * @param Throwable                  $exception The captured flow processor exception.
     *
     * @return bool
     */
    public function error(Container $input, Throwable $exception)
    {
        return false;
    }
}
