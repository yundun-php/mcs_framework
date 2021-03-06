<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Flow\Traits;

use RuntimeException;
use YundunMcs\Container\Store;
use YundunMcs\Flow\Contracts\Processor;

trait ProcessorStoreSupport
{
    /**
     * Get flow processor store instance.
     *
     * @return YundunMcs\Container\Store
     */
    abstract protected function getStore(): Store;

    /**
     * Determines whether the current processor store is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->getStore()->isEmpty();
    }

    /**
     * Append the given processor to the current processor store.
     *
     * @param YundunMcs\Flow\Contracts\Processor $processor The given processor.
     * @param bool                            $top       Append to the top of the processor store.
     *
     * @return int
     */
    public function append(Processor $processor, bool $top = false): int
    {
        return $this->getStore()->append($processor, $top);
    }

    /**
     * Remove a processor from the current processor store.
     *
     * @param bool $top Remove the processor from the top of the processor store.
     *
     * @throws RuntimeException Throws when the current processor store is empty.
     *
     * @return YundunMcs\Flow\Contracts\Processor
     */
    public function remove(bool $top = true): Processor
    {
        if ($this->isEmpty()) {
            throw new RuntimeException(
                'Unable to remove processor from empty processor container.'
            );
        }

        return $this->getStore()->remove($top);
    }

    /**
     * Clear the current processor store.
     *
     * @return self
     */
    public function clear()
    {
        $this->getStore()->clear();

        return $this;
    }
}
