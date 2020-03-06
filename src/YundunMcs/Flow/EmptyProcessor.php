<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Flow;

use YundunMcs\Flow\Contracts\Processor;
use YundunMcs\Flow\Traits\EmptyProcessorSupport;

class EmptyProcessor implements Processor
{
    use EmptyProcessorSupport;
}
