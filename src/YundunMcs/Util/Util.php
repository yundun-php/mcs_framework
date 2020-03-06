<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Util;

use Closure;
use YundunMcs\Util\Contracts\Wrapper;

class Util
{
    /**
     * Get the original value of the given value.
     *
     * @param mixed $value The given value.
     *
     * @return mixed
     */
    public static function value($value)
    {
        if ($value instanceof Wrapper) {
            return $value->getOriginal();
        } elseif ($value instanceof Closure) {
            return $value();
        } else {
            return $value;
        }
    }
}
