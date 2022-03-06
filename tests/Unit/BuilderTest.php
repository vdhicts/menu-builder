<?php

namespace Vdhicts\Menu\Tests;

use PHPUnit\Framework\TestCase;
use Vdhicts\Menu\Builder;
use Vdhicts\Menu\Item;
use Vdhicts\Menu\ItemCollection;
use Vdhicts\Menu\Renderers;

class BuilderTest extends TestCase
{
    private function getBaseItemCollection()
    {
        $item = new Item(1, 'Search engines');
        $subItemGoogle = new Item(2, 'Google', 'http://www.google.com', $item->getId());
        $subItemDivider = new Item(4, '', null, $item->getId(), true);
        $subItemBing = new Item(3, 'Bing', 'http://www.bing.com', $item->getId());

        $itemCollection = new ItemCollection();
        $itemCollection
            ->addItem($item)
            ->addItem($subItemGoogle)
            ->addItem($subItemDivider)
            ->addItem($subItemBing);

        return $itemCollection;
    }

    public function testListGroup()
    {
        $builder = new Builder($this->getBaseItemCollection(), new Renderers\ListGroup());

        $this->assertInstanceOf(Builder::class, $builder);
        $this->assertInstanceOf(ItemCollection::class, $builder->getItems());
        $this->assertInstanceOf(Renderers\ListGroup::class, $builder->getRenderer());

        $expectedHtml = '<ul class="list-group"><li class="list-group-item">Search engines<ul class="list-group"><li class="list-group-item"><a href="http://www.google.com">Google</a></li><li class="list-group-item list-group-item-divider"></li><li class="list-group-item"><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }

    public function testListInline()
    {
        $builder = new Builder($this->getBaseItemCollection(), new Renderers\ListInline());

        $this->assertInstanceOf(Builder::class, $builder);
        $this->assertInstanceOf(ItemCollection::class, $builder->getItems());
        $this->assertInstanceOf(Renderers\ListInline::class, $builder->getRenderer());

        $expectedHtml = '<ul class="list-inline"><li>Search engines<ul class="list-inline"><li><a href="http://www.google.com">Google</a></li><li class="list-inline-divider"></li><li><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }

    public function testNavbar()
    {
        $builder = new Builder($this->getBaseItemCollection(), new Renderers\Navbar());

        $this->assertInstanceOf(Builder::class, $builder);
        $this->assertInstanceOf(ItemCollection::class, $builder->getItems());
        $this->assertInstanceOf(Renderers\Navbar::class, $builder->getRenderer());

        $expectedHtml = '<ul class="nav navbar-nav"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Search engines<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="http://www.google.com">Google</a></li><li class="divider" role="separator"></li><li><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }
}
