<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Event\Contracts;

interface Collector
{
    /**
     * Add an event listener for the specified event.
     *
     * @param string                                   $name     The event name.
     * @param YundunMcs\Event\Contracts\Listener|callable $listener The event listener.
     *
     * @return self
     */
    public function on(string $name, $listener);
}
