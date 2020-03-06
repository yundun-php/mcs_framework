<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Event;

use YundunMcs\Event\Traits\TriggerSupport;
use YundunMcs\Event\Contracts\Trigger as TriggerContract;

class Trigger extends DispatcherContainer implements TriggerContract
{
    use TriggerSupport;
}
