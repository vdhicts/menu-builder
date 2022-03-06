<?php

namespace Vdhicts\Menu\Tests;

use PHPUnit\Framework\TestCase;
use Vdhicts\Menu\Exceptions;
use Vdhicts\Menu\Item;

class ItemTest extends TestCase
{
    public function testItemWithAllProperties()
    {
        $id = 1;
        $name = 'Google';
        $link = 'http://www.google.com';
        $parentId = 1;
        $isDivider = false;

        $item = new Item($id, $name, $link, $parentId, $isDivider);

        $this->assertInstanceOf(Item::class, $item);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());
        $this->assertSame($link, $item->getLink());
        $this->assertTrue($item->hasLink());
        $this->assertSame($parentId, $item->getParentId());
        $this->assertTrue($item->hasParent());
        $this->assertSame($isDivider, $item->isDivider());
    }

    public function testItemWithDefaults()
    {
        $id = 1;
        $name = 'Google';

        $item = new Item($id, $name);

        $this->assertInstanceOf(Item::class, $item);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());
        $this->assertNull($item->getLink());
        $this->assertFalse($item->hasLink());
        $this->assertNull($item->getParentId());
        $this->assertFalse($item->hasParent());
        $this->assertFalse($item->isDivider());
    }

    public function testItemWithInvalidTarget()
    {
        $this->expectException(Exceptions\InvalidLinkException::class);

        new Item(1, 'test', 'test');
    }
}
