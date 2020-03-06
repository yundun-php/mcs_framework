<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Config;

use YundunMcs\Util\Arr;
use RuntimeException;
use YundunMcs\Event\Factory;
use YundunMcs\Event\Trigger;
use YundunMcs\Event\Collector;
use YundunMcs\Event\Dispatcher;
use InvalidArgumentException;
use YundunMcs\Config\Loaders\CallableLoader;
use YundunMcs\Config\Contracts\Config as ConfigContract;

class Config extends Collector implements ConfigContract
{
    /**
     * The event trigger.
     *
     * @var YundunMcs\Event\Trigger
     */
    protected $trigger;

    /**
     * The configuration group load flow.
     *
     * @var YundunMcs\Config\Flow
     */
    protected $flow;

    /**
     * All loaded configuration groups.
     *
     * @var array
     */
    protected $groups = [];

    /**
     * The config constructor.
     *
     * @param iterable                $loaders    The configuration group loaders.
     * @param YundunMcs\Event\Dispatcher $dispatcher The configuration event dispatcher.
     *
     * @return void
     */
    public function __construct(iterable $loaders = [], Dispatcher $dispatcher = null)
    {
        // Initialize the configuration event collector. If no event distributor is given,
        // the system automatically creates a default event distributor with an "edoger"
        // top-level namespace.
        parent::__construct($dispatcher ?: Factory::createYundunMcsDispatcher(), 'config');

        // Initialize the event trigger and load the flow manager.
        $this->trigger = new Trigger($this->getEventDispatcher(), 'config');
        $this->flow    = new Flow(new Blocker($this->getEventTrigger()));

        // Add predefined configuration group loaders.
        foreach ($loaders as $loader) {
            $this->pushLoader($loader);
        }
    }

    /**
     * Get the configuration event trigger.
     *
     * @return YundunMcs\Event\Trigger
     */
    protected function getEventTrigger(): Trigger
    {
        return $this->trigger;
    }

    /**
     * Get the configuration group load flow.
     *
     * @return YundunMcs\Config\Flow
     */
    protected function getLoadFlow(): Flow
    {
        return $this->flow;
    }

    /**
     * Load a configuration group with a given name.
     *
     * @param string $group  The configuration group name.
     * @param bool   $reload Whether to reload the configuration group.
     *
     * @return YundunMcs\Config\Repository
     */
    protected function load(string $group, bool $reload): Repository
    {
        $trigger = $this->getEventTrigger();

        if ($trigger->hasEventListener('loading')) {
            $trigger->emit('loading', ['group' => $group, 'reload' => $reload]);
        }

        $repository = $this->getLoadFlow()->start(['group' => $group, 'reload' => $reload]);

        if ($trigger->hasEventListener('loaded')) {
            $trigger->emit('loaded', [
                'group'      => $group,
                'reload'     => $reload,
                'repository' => $repository,
            ]);
        }

        return $repository;
    }

    /**
     * Determines whether the current loader collection is empty.
     *
     * @return bool
     */
    public function isEmptyLoaders(): bool
    {
        return $this->getLoadFlow()->isEmpty();
    }

    /**
     * Get the size of the current group configuration loader collection.
     *
     * @return int
     */
    public function countLoaders(): int
    {
        return $this->getLoadFlow()->count();
    }

    /**
     * Gets the current configuration group loaders.
     *
     * @return array
     */
    public function getLoaders(): array
    {
        $loaders = $this->getLoadFlow()->toArray();

        if (empty($loaders)) {
            return $loaders;
        }

        // The loader is stored in the form of a stack,
        // and we have to restore the order of their additions.
        return array_reverse($loaders);
    }

    /**
     * Append a configuration group loader.
     *
     * @param YundunMcs\Config\AbstractLoader|callable $loader The configuration group loader.
     *
     * @return int
     */
    public function pushLoader($loader): int
    {
        if ($loader instanceof AbstractLoader) {
            return $this->getLoadFlow()->append($loader, true);
        }

        // For a callable structure, we wrap it as a "YundunMcs\Config\Loaders\CallableLoader"
        // instance, and we do not automatically restore it when we get it.
        if (is_callable($loader)) {
            return $this->getLoadFlow()->append(new CallableLoader($loader), true);
        }

        throw new InvalidArgumentException('Invalid configuration group loader.');
    }

    /**
     * Delete and return a configuration group loader.
     *
     * @throws RuntimeException Throws when the configuration group loader collection is empty.
     *
     * @return YundunMcs\Config\AbstractLoader
     */
    public function popLoader(): AbstractLoader
    {
        if ($this->isEmptyLoaders()) {
            throw new RuntimeException(
                'Unable to remove loader from the empty loader stack.'
            );
        }

        return $this->getLoadFlow()->remove(true);
    }

    /**
     * Clear the current configuration group loader collection.
     *
     * @return self
     */
    public function clearLoaders(): self
    {
        $this->getLoadFlow()->clear();

        return $this;
    }

    /**
     * Gets the configuration group collection for the given name.
     * If the configuration group does not exist, an empty collection is returned.
     *
     * @param string $group  The configuration group name.
     * @param bool   $reload Whether to reload the configuration group.
     *
     * @return YundunMcs\Config\Repository
     */
    public function group(string $group, bool $reload = false): Repository
    {
        if ($reload || !Arr::has($this->groups, $group)) {
            $this->groups[$group] = $this->load($group, $reload);
        }

        return $this->groups[$group];
    }
}
