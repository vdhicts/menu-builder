<?php

namespace Vdhicts\Menu\Renderers;

use Vdhicts\HtmlElement\HtmlElement;
use Vdhicts\Menu\Contracts;
use Vdhicts\Menu\Item;
use Vdhicts\Menu\ItemCollection;

class ListGroup implements Contracts\Renderer
{
    /**
     * Renders a single item.
     * @param Item $item
     * @return HtmlElement
     */
    public function generateItem(Item $item): HtmlElement
    {
        $listGroupItem = new HtmlElement('li', '', ['class' => 'list-group-item']);

        // When the item is a divider, just add the class and we're done
        if ($item->isDivider()) {
            $listGroupItem->addAttributeValue('class', 'list-group-item-divider');
            return $listGroupItem;
        }

        // Create a link if the item has a link and isn't a divider
        if ($item->hasLink()) {
            $link = new HtmlElement('a', $item->getName(), ['href' => $item->getLink()]);
            $listGroupItem->inject($link);
        } else { // Otherwise the item is just a div
            $listGroupItem->setText($item->getName());
        }

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
        $list = new HtmlElement('ul', '', ['class' => 'list-group']);
        foreach ($itemCollection->getChildren($parentId) as $itemId) {
            $listItem = $this->generateItem($itemCollection->getItem($itemId));

            // Generate children recursively
            $hasChildren = $itemCollection->hasChildren($itemId);
            if ($hasChildren) {
                $listItem->addText($this->generate($itemCollection, $itemId));
            }

            $list->inject($listItem);
        }
        return $list->generate();
    }
}
