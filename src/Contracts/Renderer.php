<?php

namespace Vdhicts\Menu\Contracts;

use Vdhicts\Menu\ItemCollection;

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
