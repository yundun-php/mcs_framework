<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Event\Contracts;

use YundunMcs\Event\Dispatcher;

interface DispatcherContainer
{
    /**
     * Gets the current event dispatcher instance.
     *
     * @return YundunMcs\Event\Dispatcher
     */
    public function getEventDispatcher(): Dispatcher;

    /**
     * Get the current subcomponent event name.
     *
     * @return string
     */
    public function getSubcomponentEventName(): string;
}
