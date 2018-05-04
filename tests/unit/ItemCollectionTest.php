<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Menu;

class ItemCollectionTest extends TestCase
{
    private function getBaseItemCollection()
    {
        $item = new Menu\Item(1, 'Search engines');
        $subItemGoogle = new Menu\Item(2, 'Google', 'http://www.google.com', $item->getId());
        $subItemBing = new Menu\Item(3, 'Bing', 'http://www.bing.com', $item->getId());

        $itemCollection = new Menu\ItemCollection();
        $itemCollection->addItem($item)
            ->addItem($subItemGoogle)
            ->addItem($subItemBing);

        return $itemCollection;
    }

    public function testItemCollectionBuild()
    {
        $itemCollection = $this->getBaseItemCollection();

        $this->assertInstanceOf(Menu\ItemCollection::class, $itemCollection);
    }

    public function testItemCollectionRetrieval()
    {
        $itemCollection = $this->getBaseItemCollection();

        $retrievedItem = $itemCollection->getItem(1);
        $this->assertInstanceOf(Menu\Item::class, $retrievedItem);
        $this->assertSame(1, $retrievedItem->getId());
    }

    public function testItemCollectionChildren()
    {
        $itemCollection = $this->getBaseItemCollection();

        $this->assertTrue($itemCollection->hasChildren());
        $this->assertTrue($itemCollection->hasChildren(1));
    }
}
