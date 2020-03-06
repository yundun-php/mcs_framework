<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Logger;

use Closure;
use YundunMcs\Container\Container;
use YundunMcs\Flow\Flow as BaseFlow;
use YundunMcs\Flow\Contracts\Processor;

class Flow extends BaseFlow
{
    /**
     * Run the flow processor.
     *
     * @param YundunMcs\Flow\Contracts\Processor $processor The flow processor.
     * @param YundunMcs\Container\Container      $input     The processor input parameter container.
     * @param Closure                         $next      The trigger for the next processor.
     *
     * @return mixed
     */
    protected function doProcess(Processor $processor, Container $input, Closure $next)
    {
        return $processor->handle($input->get('channel'), $input->get('log'), $next);
    }
}
