<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Util\Mocks;

use YundunMcs\Util\Contracts\Wrapper;

class TestWrapper implements Wrapper
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getOriginal()
    {
        return $this->value;
    }
}
