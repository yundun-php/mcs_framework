<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Event\Traits;

use YundunMcs\Event\Dispatcher;

trait CollectorSupport
{
    /**
     * Gets the current event dispatcher instance.
     *
     * @return YundunMcs\Event\Dispatcher
     */
    abstract public function getEventDispatcher(): Dispatcher;

    /**
     * Get the current subcomponent event name.
     *
     * @return string
     */
    abstract public function getSubcomponentEventName(): string;

    /**
     * Standardize the gievn event name.
     *
     * @param string $name The gievn event name.
     *
     * @return string
     */
    abstract protected function standardizeEventName(string $name): string;

    /**
     * Add an event listener for the specified event.
     *
     * @param string                                   $name     The event name.
     * @param YundunMcs\Event\Contracts\Listener|callable $listener The event listener.
     *
     * @return self
     */
    public function on(string $name, $listener)
    {
        $this->getEventDispatcher()->addListener($this->standardizeEventName($name), $listener);

        return $this;
    }
}
