<?php

namespace Vdhicts\MenuBuilder\Renderers;

use Vdhicts\HtmlElement\HtmlElement;
use Vdhicts\MenuBuilder\Contracts;
use Vdhicts\MenuBuilder\Item;
use Vdhicts\MenuBuilder\ItemCollection;

class ListGroup implements Contracts\Renderer
{
    /**
     * Renders a single item.
     * @param Item $item
     * @return HtmlElement
     */
    public function generateItem(Item $item): HtmlElement
    {
        // Create a link if the item has a link and isn't a divider
        if ($item->hasLink() && ! $item->isDivider()) {
            $listGroupItem = new HtmlElement('a');
            $listGroupItem->setAttribute('href', $item->getLink());
        } else { // Otherwise the item is just a div
            $listGroupItem = new HtmlElement('div');
        }

        // Add the required css class
        $listGroupItem->setAttribute('class', 'list-group-item');

        // When the item is a divider, we are done
        if ( ! $item->isDivider()) {
            return $listGroupItem;
        }

        // Set the text
        $listGroupItem->setText($item->getName());

        return $listGroupItem;
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

        $list = new HtmlElement('ul', ['class' => 'list-group']);
        foreach ($itemCollection->getChildren($parentId) as $itemId) {
            $list->inject($this->generateItem($itemCollection->getItem($itemId)));
        }
        return $list->generate();
    }
}
