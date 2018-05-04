<?php

namespace Vdhicts\Dicms\Menu;

class Builder
{
    /**
     * Holds the item collection.
     * @var ItemCollection
     */
    private $itemCollection;

    /**
     * Holds the renderer.
     * @var Contracts\Renderer
     */
    private $renderer;

    /**
     * Builder constructor.
     * @param ItemCollection $itemCollection
     * @param Contracts\Renderer $renderer
     */
    public function __construct(ItemCollection $itemCollection, Contracts\Renderer $renderer)
    {
        $this->setItems($itemCollection);
        $this->setRenderer($renderer);
    }

    /**
     * Returns the item collection.
     * @return ItemCollection
     */
    public function getItemCollection(): ItemCollection
    {
        return $this->itemCollection;
    }

    /**
     * Stores the item collection.
     * @param ItemCollection $itemCollection
     */
    private function setItems(ItemCollection $itemCollection)
    {
        $this->itemCollection = $itemCollection;
    }

    /**
     * Returns the renderer.
     * @return Contracts\Renderer
     */
    public function getRenderer(): Contracts\Renderer
    {
        return $this->renderer;
    }

    /**
     * Stores the renderer.
     * @param Contracts\Renderer $renderer
     */
    private function setRenderer(Contracts\Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Builds the menu.
     * @param mixed $parentId
     * @return string
     */
    public function generate($parentId = null): string
    {
        return $this->getRenderer()
            ->generate($this->getItemCollection(), $parentId);
    }
}
