<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Flow\Mocks;

use Closure;
use Exception;
use YundunMcs\Container\Container;
use YundunMcs\Flow\Contracts\Processor;

class TestExceptionProcessor implements Processor
{
    protected $map;

    public function __construct(array $map = [])
    {
        $this->map = $map;
    }

    public function process(Container $input, Closure $next)
    {
        if ($input->has('key')) {
            $key = $input->get('key');

            if (isset($this->map[$key])) {
                throw new Exception($this->map[$key]);
            }
        }

        return $next();
    }
}
