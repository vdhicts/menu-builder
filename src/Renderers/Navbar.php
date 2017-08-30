<?php

namespace Vdhicts\MenuBuilder\Renderers;

use Vdhicts\HtmlElement\HtmlElement;
use Vdhicts\MenuBuilder\Contracts;
use Vdhicts\MenuBuilder\Item;
use Vdhicts\MenuBuilder\ItemCollection;

class Navbar implements Contracts\Renderer
{
    /**
     * Renders a single item.
     * @param Item $item
     * @param bool $hasChildren
     * @return HtmlElement
     */
    public function generateItem(Item $item, bool $hasChildren = false): HtmlElement
    {
        // Create the list item element
        $listItem = new HtmlElement('li');

        // When the item is a divider, set the divider class and return the list-item
        if ($item->isDivider()) {
            $listItem->setAttribute('class', 'divider');
            return $listItem;
        }

        // When the item has children, set the dropdown class
        if ($hasChildren) {
            $listItem->setAttribute('class', 'dropdown');
        }

        // Create the link
        $listItemLink = new HtmlElement('a');
        if ($item->hasLink()) {
            $listItemLink->setAttribute('href', $item->getLink());
        } else {
            $listItemLink->setAttribute('href', '#');
        }
        $listItemLink->setText($item->getName());

        // When the menu item has children, add the proper classes and the caret
        if ($hasChildren) {
            $listItemLink->setAttribute('class', 'dropdown-toggle');
            $listItemLink->setAttribute('data-toggle', 'dropdown');

            $caret = new HtmlElement('span', ['class' => 'caret']);
            $listItemLink->addText($caret->generate());
        }

        // Add the link to the list-item
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

        // Create the unordered list for the navbar
        $list = new HtmlElement('ul');

        // When it isn't a submenu, add the navbar css classes
        if (is_null($parentId)) {
            $list->setAttribute('class', 'nav navbar-nav');
        } else { // Otherwise add the dropdown css class
            $list->setAttribute('class', 'dropdown-menu');
        }

        // Generate the navbar for the items
        foreach ($itemCollection->getChildren($parentId) as $itemId) {
            $hasChildren = $itemCollection->hasChildren($itemId);
            $listItem = $this->generateItem($itemCollection->getItem($itemId), $hasChildren);

            // Generate children recursively
            if ($hasChildren) {
                $listItem->addText($this->generate($itemCollection, $itemId));
            }

            $list->inject($listItem);
        }
        return $list->generate();
    }
}
