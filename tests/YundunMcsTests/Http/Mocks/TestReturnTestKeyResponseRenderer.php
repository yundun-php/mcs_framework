<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Http\Mocks;

use YundunMcs\Http\Foundation\Collection;
use YundunMcs\Http\Server\Contracts\ResponseRenderer;

class TestReturnTestKeyResponseRenderer implements ResponseRenderer
{
    public function render(Collection $content): string
    {
        return $content->get('test', '');
    }
}
