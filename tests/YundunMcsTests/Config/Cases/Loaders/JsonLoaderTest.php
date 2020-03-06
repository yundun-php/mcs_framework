<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Config\Cases\Loaders;

use YundunMcs\Config\Config;
use YundunMcs\Config\Repository;
use PHPUnit\Framework\TestCase;
use YundunMcs\Config\AbstractLoader;
use YundunMcs\Config\AbstractFileLoader;
use YundunMcs\Config\Loaders\JsonLoader;
use YundunMcs\Serializer\Exceptions\SerializerException;

class JsonLoaderTest extends TestCase
{
    protected $config;

    public static function setUpBeforeClass()
    {
        $dir = EDOGER_TESTS_TEMP;

        @file_put_contents(EDOGER_TESTS_TEMP.'/test.json', json_encode(['key' => 'foo']));
        @file_put_contents(EDOGER_TESTS_TEMP.'/test.suffix.json', json_encode(['key' => 'bar']));
        @file_put_contents(EDOGER_TESTS_TEMP.'/bad.json', '"bad"');
        @file_put_contents(EDOGER_TESTS_TEMP.'/error.json', 'error');

        // Make sure the file does not exist.
        if (file_exists(EDOGER_TESTS_TEMP.'/non.json')) {
            @unlink(EDOGER_TESTS_TEMP.'/non.json');
        }
    }

    public static function tearDownAfterClass()
    {
        $files = ['/test.json', '/test.suffix.json', '/bad.json', '/error.json'];

        foreach ($files as $value) {
            if (file_exists(EDOGER_TESTS_TEMP.$value)) {
                @unlink(EDOGER_TESTS_TEMP.$value);
            }
        }
    }

    protected function setUp()
    {
        $this->config = new Config();
    }

    protected function tearDown()
    {
        $this->config = null;
    }

    protected function createJsonLoader(string $suffix = null)
    {
        if (is_null($suffix)) {
            return new JsonLoader(EDOGER_TESTS_TEMP);
        }

        return new JsonLoader(EDOGER_TESTS_TEMP, $suffix);
    }

    public function testJsonLoaderExtendsAbstractLoader()
    {
        $loader = $this->createJsonLoader();

        $this->assertInstanceOf(AbstractLoader::class, $loader);
    }

    public function testJsonLoaderExtendsAbstractFileLoader()
    {
        $loader = $this->createJsonLoader();

        $this->assertInstanceOf(AbstractFileLoader::class, $loader);
    }

    public function testJsonLoaderWithDefaultSuffix()
    {
        $this->config->pushLoader($this->createJsonLoader());

        $group = $this->config->group('test');

        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals(['key' => 'foo'], $group->toArray());
    }

    public function testJsonLoaderWithUserSuffix()
    {
        $this->config->pushLoader($this->createJsonLoader('.suffix.json'));

        $group = $this->config->group('test');

        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals(['key' => 'bar'], $group->toArray());
    }

    public function testJsonLoaderFileNotExists()
    {
        $this->config->pushLoader($this->createJsonLoader());

        $group = $this->config->group('non'); // not found

        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals([], $group->toArray());
    }

    public function testJsonLoaderBadFile()
    {
        $this->config->pushLoader($this->createJsonLoader());

        $group = $this->config->group('bad'); // bad

        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals(['bad' => 'bad'], $group->toArray());
    }

    public function testJsonLoaderErrorFile()
    {
        $error = false;

        $this->config->pushLoader($this->createJsonLoader());
        $this->config->on('error', function ($event) use (&$error) {
            $this->assertInstanceOf(SerializerException::class, $event->get('exception'));

            $error = true;
        });

        $group = $this->config->group('error');

        $this->assertTrue($error);
        $this->assertInstanceOf(Repository::class, $group);
        $this->assertEquals([], $group->toArray());
    }
}
