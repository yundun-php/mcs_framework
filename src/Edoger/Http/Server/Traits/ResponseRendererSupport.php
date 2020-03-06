<?php

/**
 * This file is part of the Edoger framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace Edoger\Http\Server\Traits;

use Edoger\Http\Server\Contracts\ResponseRenderer;
use Edoger\Http\Server\Response\Renderers\EmptyRenderer;

trait ResponseRendererSupport
{
    /**
     * The HTTP response body renderer.
     *
     * @var Edoger\Http\Contracts\ResponseRenderer|null
     */
    protected $renderer = null;

    /**
     * Set the HTTP response body renderer.
     *
     * @param Edoger\Http\Contracts\ResponseRenderer $renderer The HTTP response body renderer.
     *
     * @return void
     */
    public function setResponseRenderer(ResponseRenderer $renderer): void
    {
        $this->renderer = $renderer;
    }

    /**
     * Get the HTTP response body renderer.
     *
     * @return Edoger\Http\Contracts\ResponseRenderer
     */
    public function getResponseRenderer(): ResponseRenderer
    {
        // If there is no set renderer, a new empty renderer is returned.
        if (is_null($this->renderer)) {
            return EmptyRenderer::create();
        }

        return $this->renderer;
    }

    /**
     * Remove the HTTP response body renderer.
     *
     * @return void
     */
    public function removeResponseRenderer(): void
    {
        $this->renderer = null;
    }
}
