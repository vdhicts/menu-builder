<?php

namespace Vdhicts\Menu;

class Builder
{
    private ItemCollection $itemCollection;
    private Contracts\Renderer $renderer;

    public function __construct(ItemCollection $itemCollection, Contracts\Renderer $renderer)
    {
        $this->setItems($itemCollection);
        $this->setRenderer($renderer);
    }

    public function getItems(): ItemCollection
    {
        return $this->itemCollection;
    }

    private function setItems(ItemCollection $itemCollection)
    {
        $this->itemCollection = $itemCollection;
    }

    public function getRenderer(): Contracts\Renderer
    {
        return $this->renderer;
    }

    private function setRenderer(Contracts\Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Builds the menu.
     * @param mixed $parentId
     */
    public function generate($parentId = null): string
    {
        return $this
            ->getRenderer()
            ->generate($this->getItems(), $parentId);
    }
}
