<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\MenuBuilder;

class ItemTest extends TestCase
{
    public function testItemWithAllProperties()
    {
        $id = 1;
        $name = 'Google';
        $target = 'http://www.google.com';
        $parentId = 1;
        $isDivider = false;

        $item = new MenuBuilder\Item($id, $name, $target, $parentId, $isDivider);

        $this->assertInstanceOf(MenuBuilder\Item::class, $item);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());
        $this->assertSame($target, $item->getTarget());
        $this->assertTrue($item->hasTarget());
        $this->assertSame($parentId, $item->getParentId());
        $this->assertTrue($item->hasParent());
        $this->assertSame($isDivider, $item->isDivider());
    }

    public function testItemWithDefaults()
    {
        $id = 1;
        $name = 'Google';

        $item = new MenuBuilder\Item($id, $name);

        $this->assertInstanceOf(MenuBuilder\Item::class, $item);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());
        $this->assertNull($item->getTarget());
        $this->assertFalse($item->hasTarget());
        $this->assertNull($item->getParentId());
        $this->assertFalse($item->hasParent());
        $this->assertFalse($item->isDivider());
    }

    public function testItemWithInvalidTarget()
    {
        $this->expectException(MenuBuilder\Exceptions\InvalidLinkException::class);

        new MenuBuilder\Item(1, 'test', 'test');
    }
}
