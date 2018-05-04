<?php

namespace Vdhicts\Dicms\Menu\Contracts;

use Vdhicts\Dicms\Menu\ItemCollection;

interface Renderer
{
    /**
     * Renders the menu.
     * @param ItemCollection $itemCollection
     * @param mixed $parentId
     * @return string
     */
    public function generate(ItemCollection $itemCollection, $parentId = null): string;
}
