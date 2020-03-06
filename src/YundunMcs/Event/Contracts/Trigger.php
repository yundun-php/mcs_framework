<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Event\Contracts;

use YundunMcs\Event\Event;

interface Trigger
{
    /**
     * Determines whether the listener for the specified event exists.
     *
     * @param string $name The event name.
     *
     * @return bool
     */
    public function hasEventListener(string $name): bool;

    /**
     * Triggers an event with the specified name.
     *
     * @param string $name The event name.
     * @param mixed  $body The event body.
     *
     * @return YundunMcs\Event\Event
     */
    public function emit(string $name, $body = []): Event;
}
