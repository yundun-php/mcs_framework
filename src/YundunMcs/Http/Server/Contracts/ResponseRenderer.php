<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Http\Server\Contracts;

use YundunMcs\Http\Foundation\Collection;

interface ResponseRenderer
{
    /**
     * Render the HTTP response body.
     *
     * @param YundunMcs\Http\Foundation\Collection $content The HTTP response content collection.
     *
     * @return string
     */
    public function render(Collection $content): string;
}
