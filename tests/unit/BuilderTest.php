<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\MenuBuilder;

class BuilderTest extends TestCase
{
    private function getBaseItemCollection()
    {
        $item = new MenuBuilder\Item(1, 'Search engines');
        $subItemGoogle = new MenuBuilder\Item(2, 'Google', 'http://www.google.com', $item->getId());
        $subItemDivider = new MenuBuilder\Item(4, '', null, $item->getId(), true);
        $subItemBing = new MenuBuilder\Item(3, 'Bing', 'http://www.bing.com', $item->getId());

        $itemCollection = new MenuBuilder\ItemCollection();
        $itemCollection->addItem($item)
            ->addItem($subItemGoogle)
            ->addItem($subItemDivider)
            ->addItem($subItemBing);

        return $itemCollection;
    }

    public function testListGroup()
    {
        $builder = new MenuBuilder\Builder($this->getBaseItemCollection(), new MenuBuilder\Renderers\ListGroup());

        $this->assertInstanceOf(MenuBuilder\Builder::class, $builder);
        $this->assertInstanceOf(MenuBuilder\ItemCollection::class, $builder->getItemCollection());
        $this->assertInstanceOf(MenuBuilder\Renderers\ListGroup::class, $builder->getRenderer());

        $expectedHtml = '<ul class="list-group"><li class="list-group-item">Search engines<ul class="list-group"><li class="list-group-item"><a href="http://www.google.com">Google</a></li><li class="list-group-item list-group-item-divider"></li><li class="list-group-item"><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }

    public function testListInline()
    {
        $builder = new MenuBuilder\Builder($this->getBaseItemCollection(), new MenuBuilder\Renderers\ListInline());

        $this->assertInstanceOf(MenuBuilder\Builder::class, $builder);
        $this->assertInstanceOf(MenuBuilder\ItemCollection::class, $builder->getItemCollection());
        $this->assertInstanceOf(MenuBuilder\Renderers\ListInline::class, $builder->getRenderer());

        $expectedHtml = '<ul class="list-inline"><li>Search engines<ul class="list-inline"><li><a href="http://www.google.com">Google</a></li><li class="list-inline-divider"></li><li><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }

    public function testNavbar()
    {
        $builder = new MenuBuilder\Builder($this->getBaseItemCollection(), new MenuBuilder\Renderers\Navbar());

        $this->assertInstanceOf(MenuBuilder\Builder::class, $builder);
        $this->assertInstanceOf(MenuBuilder\ItemCollection::class, $builder->getItemCollection());
        $this->assertInstanceOf(MenuBuilder\Renderers\Navbar::class, $builder->getRenderer());

        $expectedHtml = '<ul class="nav navbar-nav"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Search engines<span class="caret"></span></a><ul class="dropdown-menu"><li><a href="http://www.google.com">Google</a></li><li class="divider" role="separator"></li><li><a href="http://www.bing.com">Bing</a></li></ul></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }
}
