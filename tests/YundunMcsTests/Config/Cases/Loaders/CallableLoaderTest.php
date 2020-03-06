<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Config\Cases\Loaders;

use Closure;
use RuntimeException;
use YundunMcs\Config\Config;
use YundunMcs\Config\Repository;
use PHPUnit\Framework\TestCase;
use YundunMcs\Config\AbstractLoader;
use YundunMcs\Config\Loaders\CallableLoader;

class CallableLoaderTest extends TestCase
{
    protected $config;

    protected function setUp()
    {
        $this->config = new Config();
    }

    protected function tearDown()
    {
        $this->config = null;
    }

    public function testCallableLoaderExtendsAbstractLoader()
    {
        $loader = new CallableLoader(function () {
            // do nothing
        });

        $this->assertInstanceOf(AbstractLoader::class, $loader);
    }

    public function testCallableLoaderLoad()
    {
        $this->config->pushLoader(
            new CallableLoader(function (string $group, bool $reload, Closure $next) {
                if ('test' === $group) {
                    return new Repository(['test' => 'test']);
                }

                return $next();
            })
        );

        $group = $this->config->group('test');
        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals(['test' => 'test'], $group->toArray());

        $group = $this->config->group('non');
        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals([], $group->toArray());
    }

    public function testCallableLoaderLoadFail()
    {
        $error = false;

        $this->config->pushLoader(
            new CallableLoader(function () {
                return 'foo';
            })
        );
        $this->config->on('error', function ($event) use (&$error) {
            $this->assertInstanceOf(RuntimeException::class, $event->get('exception'));
            $this->assertEquals(
                'The configuration group callable loader must return "YundunMcs\Config\Repository" instance.',
                $event->get('exception')->getMessage()
            );

            $error = true;
        });

        $group = $this->config->group('test');

        $this->assertTrue($error);
        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals([], $group->toArray());
    }
}
