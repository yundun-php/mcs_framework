<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Flow\Mocks;

use YundunMcs\Flow\Contracts\Processor;
use YundunMcs\Flow\Traits\EmptyProcessorSupport;

class TestEmptyProcessor implements Processor
{
    use EmptyProcessorSupport;
}
