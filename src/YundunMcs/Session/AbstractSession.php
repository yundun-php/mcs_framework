<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Session;

use Countable;
use ArrayIterator;
use IteratorAggregate;
use YundunMcs\Util\Contracts\Arrayable;
use YundunMcs\Session\Contracts\SessionStore;
use YundunMcs\Session\Contracts\SessionHandler;

abstract class AbstractSession implements Countable, Arrayable, IteratorAggregate
{
    /**
     * The session data store.
     *
     * @var YundunMcs\Session\Contracts\SessionStore
     */
    protected $store;

    /**
     * The session handler.
     *
     * @var YundunMcs\Session\Contracts\SessionHandler
     */
    protected $handler;

    /**
     * The current session id.
     *
     * @var string
     */
    protected $sessionId = '';

    /**
     * The session constructor.
     *
     * @param YundunMcs\Session\Contracts\SessionStore   $store   The session data store.
     * @param YundunMcs\Session\Contracts\SessionHandler $handler The session handler.
     *
     * @return void
     */
    public function __construct(SessionStore $store, SessionHandler $handler)
    {
        $this->setSessionStore($store);
        $this->handler = $handler;
    }

    /**
     * Get the id of the current session, if an empty string is returned,
     * the current session is not started.
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Determine if the current session has started.
     *
     * @return bool
     */
    public function isStarted(): bool
    {
        return '' !== $this->getSessionId();
    }

    /**
     * Get the current session handler.
     *
     * @return YundunMcs\Session\Contracts\SessionHandler
     */
    public function getSessionHandler(): SessionHandler
    {
        return $this->handler;
    }

    /**
     * Get the current session data store.
     *
     * @return YundunMcs\Session\Contracts\SessionStore
     */
    public function getSessionStore(): SessionStore
    {
        return $this->store;
    }

    /**
     * Set the current session data store.
     *
     * @param YundunMcs\Session\Contracts\SessionStore $store The session data store.
     *
     * @return void
     */
    public function setSessionStore(SessionStore $store): void
    {
        $this->store = $store;
    }

    /**
     * Determine if the current session data is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->getSessionStore()->isEmpty();
    }

    /**
     * Determines if the given session data key exists.
     *
     * @param string $key The given session data key.
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->getSessionStore()->has($key);
    }

    /**
     * Gets the value of the given session data key.
     *
     * @param string $key     The given session data key.
     * @param mixed  $default The default value.
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->getSessionStore()->get($key, $default);
    }

    /**
     * Get all session data.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->getSessionStore()->getAll();
    }

    /**
     * Set a session data.
     *
     * @param string $key   The session data key.
     * @param mixed  $value The session data value.
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this->getSessionStore()->set($key, $value);
    }

    /**
     * Delete the session data for a given key name.
     *
     * @param string $key The given session data key.
     *
     * @return self
     */
    public function delete(string $key): self
    {
        $this->getSessionStore()->delete($key);

        return $this;
    }

    /**
     * Clear all the current session data.
     *
     * @return self
     */
    public function clear(): self
    {
        $this->getSessionStore()->clear();

        return $this;
    }

    /**
     * Gets the size of the current session instance.
     *
     * @return int
     */
    public function count()
    {
        return count($this->getAll());
    }

    /**
     * Returns the current session instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->getAll();
    }

    /**
     * Gets an iterator instance of the current session instance.
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->getAll());
    }

    /**
     * Start the current session.
     *
     * @param string $sessionId The session id.
     *
     * @return bool
     */
    abstract public function start(string $sessionId = ''): bool;
}
