<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Flow\Contracts;

interface Flow
{
    /**
     * Start the current flow processor queue.
     *
     * @param mixed $input The processor parameters.
     *
     * @return mixed
     */
    public function start($input = []);
}
