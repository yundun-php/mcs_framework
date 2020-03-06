<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Flow\Mocks;

use Throwable;
use YundunMcs\Container\Container;
use YundunMcs\Flow\Contracts\Blocker;

class TestBlocker implements Blocker
{
    public function block(Container $input, $result)
    {
        return ['block', $input->toArray(), $result];
    }

    public function complete(Container $input)
    {
        return ['complete', $input->toArray(), null];
    }

    public function error(Container $input, Throwable $exception)
    {
        return ['error', $input->toArray(), get_class($exception), $exception->getMessage()];
    }
}
