<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Flow\Traits;

use Closure;
use YundunMcs\Container\Container;

trait EmptyProcessorSupport
{
    /**
     * Process the current task.
     *
     * @param YundunMcs\Container\Container $input The processor input parameter container.
     * @param Closure                    $next  The trigger for the next processor.
     *
     * @return mixed
     */
    public function process(Container $input, Closure $next)
    {
        // This processor only triggers the next processor and does nothing.
        // This is done solely to implement the processor interface.
        return $next();
    }
}
