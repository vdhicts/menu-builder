<?php

namespace Vdhicts\MenuBuilder\Contracts;

use Vdhicts\MenuBuilder\ItemCollection;

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
