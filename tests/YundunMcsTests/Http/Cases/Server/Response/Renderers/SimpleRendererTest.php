<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcsTests\Http\Cases\Server\Response\Renderers;

use PHPUnit\Framework\TestCase;
use YundunMcs\Http\Foundation\Collection;
use YundunMcs\Http\Server\Contracts\ResponseRenderer;
use YundunMcs\Http\Server\Response\Renderers\SimpleRenderer;

class SimpleRendererTest extends TestCase
{
    public function testSimpleRendererInstanceOfResponseRenderer()
    {
        $renderer = new SimpleRenderer('');

        $this->assertInstanceOf(ResponseRenderer::class, $renderer);
    }

    public function testSimpleRendererCreate()
    {
        $renderer = SimpleRenderer::create();

        $this->assertInstanceOf(ResponseRenderer::class, $renderer);
    }

    public function testSimpleRendererRender()
    {
        $collection = new Collection();

        $this->assertEquals('', SimpleRenderer::create()->render($collection));
        $this->assertEquals('foo', SimpleRenderer::create('foo')->render($collection));
    }
}
