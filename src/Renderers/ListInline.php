<?php

namespace Vdhicts\MenuBuilder\Renderers;

use Vdhicts\HtmlElement\HtmlElement;
use Vdhicts\MenuBuilder\Contracts;
use Vdhicts\MenuBuilder\Item;
use Vdhicts\MenuBuilder\ItemCollection;

class ListInline implements Contracts\Renderer
{
    /**
     * Renders a single item.
     * @param Item $item
     * @return HtmlElement
     */
    public function generateItem(Item $item): HtmlElement
    {
        $listItem = new HtmlElement('li');

        // When the item is a divider, we return an empty list-item
        if ($item->isDivider()) {
            $listItem->setAttribute('class', 'list-divider');
            return $listItem;
        }

        // When the item has no link
        if (! $item->hasLink()) {
            $listItem->setText($item->getName());
            return $listItem;
        }

        // Create the link
        $listItemLink = new HtmlElement('a');
        $listItemLink->setAttribute('href', $item->getLink());
        $listItemLink->setText($item->getName());

        // Add the link to the list item
        $listItem->inject($listItemLink);

        return $listItem;
    }

    /**
     * Renders the menu.
     * @param ItemCollection $itemCollection
     * @param mixed $parentId
     * @return string
     */
    public function generate(ItemCollection $itemCollection, $parentId = null): string
    {
        if (! $itemCollection->hasChildren($parentId)) {
            return '';
        }

        $list = new HtmlElement('ul', ['class' => 'list-inline']);
        foreach ($itemCollection->getChildren($parentId) as $itemId) {
            $list->inject($this->generateItem($itemCollection->getItem($itemId)));
        }
        return $list->generate();
    }
}
