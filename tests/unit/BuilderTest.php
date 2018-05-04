<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Menu;

class BuilderTest extends TestCase
{
    private function getBaseItemCollection()
    {
        $item = new Menu\Item(1, 'Search engines');
        $subItemGoogle = new Menu\Item(2, 'Google', 'http://www.google.com', $item->getId());
        $subItemDivider = new Menu\Item(4, '', null, $item->getId(), true);
        $subItemBing = new Menu\Item(3, 'Bing', 'http://www.bing.com', $item->getId());

        $itemCollection = new Menu\ItemCollection();
        $itemCollection->addItem($item)
            ->addItem($subItemGoogle)
            ->addItem($subItemDivider)
            ->addItem($subItemBing);

        return $itemCollection;
    }

    public function testListGroup()
    {
        $builder = new Menu\Builder($this->getBaseItemCollection(), new Menu\Renderers\ListGroup());

        $this->assertInstanceOf(Menu\Builder::class, $builder);
        $this->assertInstanceOf(Menu\ItemCollection::class, $builder->getItemCollection());
        $this->assertInstanceOf(Menu\Renderers\ListGroup::class, $builder->getRenderer());

        $expectedHtml = '<ul class="list-group"><li class="list-group-item">Search engines<ul class="list-group"><li class="list-group-item"><a href="http://www.google.com">Google</a></li><li class="list-group-item list-group-item-divider"></li><li class="list-group-item"><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }

    public function testListInline()
    {
        $builder = new Menu\Builder($this->getBaseItemCollection(), new Menu\Renderers\ListInline());

        $this->assertInstanceOf(Menu\Builder::class, $builder);
        $this->assertInstanceOf(Menu\ItemCollection::class, $builder->getItemCollection());
        $this->assertInstanceOf(Menu\Renderers\ListInline::class, $builder->getRenderer());

        $expectedHtml = '<ul class="list-inline"><li>Search engines<ul class="list-inline"><li><a href="http://www.google.com">Google</a></li><li class="list-inline-divider"></li><li><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }

    public function testNavbar()
    {
        $builder = new Menu\Builder($this->getBaseItemCollection(), new Menu\Renderers\Navbar());

        $this->assertInstanceOf(Menu\Builder::class, $builder);
        $this->assertInstanceOf(Menu\ItemCollection::class, $builder->getItemCollection());
        $this->assertInstanceOf(Menu\Renderers\Navbar::class, $builder->getRenderer());

        $expectedHtml = '<ul class="nav navbar-nav"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Search engines<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="http://www.google.com">Google</a></li><li class="divider" role="separator"></li><li><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }
}
