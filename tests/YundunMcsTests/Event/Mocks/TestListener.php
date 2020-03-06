<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Event\Mocks;

use YundunMcs\Event\Event;
use YundunMcs\Event\Dispatcher;
use YundunMcs\Event\Contracts\Listener;

class TestListener implements Listener
{
    protected $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    public function handle(Event $event, Dispatcher $dispatcher): void
    {
        echo $this->message;
    }
}
