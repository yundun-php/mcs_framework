<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Config;

use Throwable;
use YundunMcs\Util\Arr;
use YundunMcs\Event\Trigger;
use YundunMcs\Container\Wrapper;
use YundunMcs\Container\Container;
use YundunMcs\Flow\Contracts\Blocker as BlockerContract;

class Blocker extends Wrapper implements BlockerContract
{
    /**
     * The configuration group load flow blocker constructor.
     *
     * @param YundunMcs\Event\Trigger $trigger [description]
     *
     * @return void
     */
    public function __construct(Trigger $trigger)
    {
        parent::__construct($trigger);
    }

    /**
     * Handle the flow block event.
     *
     * @param YundunMcs\Container\Container $input  The processor input parameter container.
     * @param YundunMcs\Config\Repository   $result The processor flow return value.
     *
     * @return YundunMcs\Config\Repository
     */
    public function block(Container $input, $result)
    {
        return $result;
    }

    /**
     * Handle the flow complete event.
     *
     * @param YundunMcs\Container\Container $input The processor input parameter container.
     *
     * @return YundunMcs\Config\Repository
     */
    public function complete(Container $input)
    {
        if ($this->getOriginal()->hasEventListener('missed')) {
            $this->getOriginal()->emit('missed', $input);
        }

        return new Repository();
    }

    /**
     * Handle the flow error event.
     *
     * @param YundunMcs\Container\Container $input     The processor input parameter container.
     * @param Throwable                  $exception The captured flow processor exception.
     *
     * @return YundunMcs\Config\Repository
     */
    public function error(Container $input, Throwable $exception)
    {
        if ($this->getOriginal()->hasEventListener('error')) {
            $this->getOriginal()->emit(
                'error',
                Arr::merge($input->toArray(), ['exception' => $exception])
            );
        }

        return new Repository();
    }
}
