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
use YundunMcs\Http\Server\Response\Renderers\EmptyRenderer;

class EmptyRendererTest extends TestCase
{
    public function testEmptyRendererInstanceOfResponseRenderer()
    {
        $renderer = new EmptyRenderer();

        $this->assertInstanceOf(ResponseRenderer::class, $renderer);
    }

    public function testEmptyRendererCreate()
    {
        $renderer = EmptyRenderer::create();

        $this->assertInstanceOf(ResponseRenderer::class, $renderer);
    }

    public function testEmptyRendererRender()
    {
        $renderer   = EmptyRenderer::create();
        $collection = new Collection();

        $this->assertEquals('', $renderer->render($collection));
    }
}
