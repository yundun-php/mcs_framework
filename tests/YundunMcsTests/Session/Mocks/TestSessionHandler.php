<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Session\Mocks;

use YundunMcs\Session\Contracts\SessionHandler;

class TestSessionHandler implements SessionHandler
{
    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function close(): bool
    {
        return true;
    }

    public function destroy($sessionId): bool
    {
        return true;
    }

    public function gc($maxLifeTime): bool
    {
        return true;
    }

    public function open($savePath, $sessionName): bool
    {
        return true;
    }

    public function read($sessionId): string
    {
        return array_key_exists($sessionId, $this->data) ? $this->data[$sessionId] : '';
    }

    public function write($sessionId, $sessionData): bool
    {
        $this->data[$sessionId] = $sessionData;

        return true;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
