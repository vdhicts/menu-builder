<?php

namespace Vdhicts\Menu\Tests;

use PHPUnit\Framework\TestCase;
use Vdhicts\Menu\Item;
use Vdhicts\Menu\ItemCollection;

class ItemCollectionTest extends TestCase
{
    private function getBaseItemCollection()
    {
        $item = new Item(1, 'Search engines');
        $subItemGoogle = new Item(2, 'Google', 'http://www.google.com', $item->getId());
        $subItemBing = new Item(3, 'Bing', 'http://www.bing.com', $item->getId());

        $itemCollection = new ItemCollection();
        $itemCollection->addItem($item)
            ->addItem($subItemGoogle)
            ->addItem($subItemBing);

        return $itemCollection;
    }

    public function testItemCollectionBuild()
    {
        $itemCollection = $this->getBaseItemCollection();

        $this->assertInstanceOf(ItemCollection::class, $itemCollection);
    }

    public function testItemCollectionRetrieval()
    {
        $itemCollection = $this->getBaseItemCollection();

        $retrievedItem = $itemCollection->getItem(1);
        $this->assertInstanceOf(Item::class, $retrievedItem);
        $this->assertSame(1, $retrievedItem->getId());
    }

    public function testItemCollectionChildren()
    {
        $itemCollection = $this->getBaseItemCollection();

        $this->assertTrue($itemCollection->hasChildren());
        $this->assertTrue($itemCollection->hasChildren(1));
    }
}
