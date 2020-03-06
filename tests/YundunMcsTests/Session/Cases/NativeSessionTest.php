<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Session\Cases;

use PHPUnit\Framework\TestCase;
use YundunMcs\Session\NativeSession;
use YundunMcs\Session\AbstractSession;
use YundunMcs\Session\Stores\GlobalSessionStore;
use YundunMcsTests\Session\Mocks\TestSessionHandler;

class NativeSessionTest extends TestCase
{
    public function testNativeSessionExtendsAbstractSession()
    {
        $session = new NativeSession(new TestSessionHandler());

        $this->assertInstanceOf(AbstractSession::class, $session);
    }

    public function testNativeSessionUsedGlobalSessionStore()
    {
        $store = (new NativeSession(new TestSessionHandler()))->getSessionStore();

        $this->assertInstanceOf(GlobalSessionStore::class, $store);
    }
}
