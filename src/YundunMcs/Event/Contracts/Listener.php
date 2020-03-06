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
use YundunMcs\Event\Dispatcher;

interface Listener
{
    /**
     * Run the current event listener.
     *
     * @param YundunMcs\Event\Event      $event      The event body.
     * @param YundunMcs\Event\Dispatcher $dispatcher The event dispatcher.
     *
     * @return void
     */
    public function handle(Event $event, Dispatcher $dispatcher): void;
}
