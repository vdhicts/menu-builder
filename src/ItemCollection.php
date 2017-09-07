<?php

namespace Vdhicts\MenuBuilder;

class ItemCollection
{
    /**
     * Holds the items indexed by their id.
     * @var array
     */
    private $items = [];

    /**
     * Holds the item id's per parent.
     * @var array
     */
    private $parents = [];

    /**
     * Returns an item.
     * @param mixed $id
     * @return null|Item
     */
    public function getItem($id)
    {
        return array_key_exists($id, $this->items)
            ? $this->items[$id]
            : null;
    }

    /**
     * Stores in item in the collection.
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item)
    {
        $itemParent = is_null($item->getParentId())
            ? 0
            : $item->getParentId();

        $this->items[$item->getId()] = $item;
        $this->parents[$itemParent][] = $item->getId();

        return $this;
    }

    /**
     * Return the child id's of the parent.
     * @param mixed $parentId
     * @return array
     */
    public function getChildren($parentId = null)
    {
        if (is_null($parentId)) {
            return $this->parents[0];
        }

        return array_key_exists($parentId, $this->parents)
            ? $this->parents[$parentId]
            : [];
    }

    /**
     * Determines if a parent has children.
     * @param mixed $parentId
     * @return bool
     */
    public function hasChildren($parentId = null)
    {
        return count($this->getChildren($parentId)) !== 0;
    }
}
