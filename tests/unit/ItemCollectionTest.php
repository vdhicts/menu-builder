<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\MenuBuilder;

class ItemCollectionTest extends TestCase
{
    private function getBaseItemCollection()
    {
        $item = new MenuBuilder\Item(1, 'Search engines');
        $subItemGoogle = new MenuBuilder\Item(2, 'Google', 'http://www.google.com', $item->getId());
        $subItemBing = new MenuBuilder\Item(3, 'Bing', 'http://www.bing.com', $item->getId());

        $itemCollection = new MenuBuilder\ItemCollection();
        $itemCollection->addItem($item)
            ->addItem($subItemGoogle)
            ->addItem($subItemBing);

        return $itemCollection;
    }

    public function testItemCollectionBuild()
    {
        $itemCollection = $this->getBaseItemCollection();

        $this->assertInstanceOf(MenuBuilder\ItemCollection::class, $itemCollection);
    }

    public function testItemCollectionRetrieval()
    {
        $itemCollection = $this->getBaseItemCollection();

        $retrievedItem = $itemCollection->getItem(1);
        $this->assertInstanceOf(MenuBuilder\Item::class, $retrievedItem);
        $this->assertSame(1, $retrievedItem->getId());
    }

    public function testItemCollectionChildren()
    {
        $itemCollection = $this->getBaseItemCollection();

        $this->assertTrue($itemCollection->hasChildren());
        $this->assertTrue($itemCollection->hasChildren(1));
    }
}
