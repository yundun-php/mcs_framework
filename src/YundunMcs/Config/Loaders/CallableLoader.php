<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Config\Loaders;

use Closure;
use RuntimeException;
use YundunMcs\Config\Repository;
use YundunMcs\Config\AbstractLoader;

class CallableLoader extends AbstractLoader
{
    /**
     * The configuration group callable loader.
     *
     * @var callable
     */
    protected $loader;

    /**
     * The callable loader constructor.
     *
     * @param callable $loader The configuration group callable loader.
     *
     * @return void
     */
    public function __construct(callable $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Load the configuration group.
     *
     * @param string  $group  The configuration group name.
     * @param bool    $reload Whether to reload the configuration group.
     * @param Closure $next   The trigger for the next loader.
     *
     * @return YundunMcs\Config\Repository
     */
    public function load(string $group, bool $reload, Closure $next): Repository
    {
        $repository = call_user_func($this->loader, $group, $reload, $next);

        if ($repository instanceof Repository) {
            return $repository;
        }

        throw new RuntimeException(
            'The configuration group callable loader must return "YundunMcs\Config\Repository" instance.'
        );
    }
}
