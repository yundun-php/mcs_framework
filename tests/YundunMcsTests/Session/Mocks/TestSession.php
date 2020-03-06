<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Session\Mocks;

use YundunMcs\Session\AbstractSession;

class TestSession extends AbstractSession
{
    public function start(string $sessionId = ''): bool
    {
        $this->sessionId = $sessionId;

        return true;
    }
}
