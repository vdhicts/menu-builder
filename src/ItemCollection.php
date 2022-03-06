<?php

namespace Vdhicts\Menu;

class ItemCollection
{
    /**
     * Holds the items indexed by their id.
     */
    private array $items = [];

    /**
     * Holds the item id's per parent.
     */
    private array $parents = [];

    /**
     * @param mixed $id
     */
    public function getItem($id): ?Item
    {
        return array_key_exists($id, $this->items)
            ? $this->items[$id]
            : null;
    }

    /**
     * @return $this
     */
    public function addItem(Item $item): self
    {
        $itemParent = is_null($item->getParentId())
            ? 0
            : $item->getParentId();

        $this->items[$item->getId()] = $item;
        $this->parents[$itemParent][] = $item->getId();

        return $this;
    }

    /**
     * @param mixed $parentId
     */
    public function getChildren($parentId = null): array
    {
        if (is_null($parentId)) {
            return $this->parents[0];
        }

        return array_key_exists($parentId, $this->parents)
            ? $this->parents[$parentId]
            : [];
    }

    /**
     * @param mixed $parentId
     */
    public function hasChildren($parentId = null): bool
    {
        return count($this->getChildren($parentId)) !== 0;
    }
}
