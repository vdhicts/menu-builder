<?php

namespace Vdhicts\MenuBuilder;

class Item
{
    /**
     * Id of the menu item.
     * @var mixed
     */
    private $id;

    /**
     * Name of the menu item.
     * @var string
     */
    private $name;

    /**
     * The target the menu item should link to.
     * @var string|null
     */
    private $target = null;

    /**
     * Parent id which the menu item belongs to.
     * @var mixed
     */
    private $parentId = null;

    /**
     * Determines if the menu item is a divider or not.
     * @var bool
     */
    private $divider = false;

    /**
     * Item constructor.
     * @param mixed $id
     * @param string $name
     * @param string|null $link
     * @param mixed $parentId
     * @param bool $divider
     */
    public function __construct($id, string $name, string $link = null, $parentId = null, bool $divider = false)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setTarget($link);
        $this->setParentId($parentId);
        $this->setDivider($divider);
    }

    /**
     * Returns the id.
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Stores the id.
     * @param mixed $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns the name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Stores the name.
     * @param string $name
     */
    private function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the link.
     * @return null|string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Determines if the menu item has a link.
     * @return bool
     */
    public function hasTarget(): bool
    {
        return ! is_null($this->getTarget());
    }

    /**
     * Stores the link.
     * @param null|string $target
     * @throws Exceptions\InvalidLinkException
     */
    private function setTarget(string $target = null)
    {
        if (! is_null($target) && ! filter_var($target, FILTER_VALIDATE_URL)) {
            throw new Exceptions\InvalidLinkException(sprintf(
                'Provided link "%s" should be a valid URL or null',
                $target
            ));
        }

        $this->target = $target;
    }

    /**
     * Returns the parent id.
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Determines if the menu item has a parent.
     * @return bool
     */
    public function hasParent()
    {
        return ! is_null($this->getParentId());
    }

    /**
     * Stores the parent id.
     * @param mixed $parentId
     */
    private function setParentId($parentId = null)
    {
        $this->parentId = $parentId;
    }

    /**
     * Returns if this item is a divider.
     * @return bool
     */
    public function isDivider(): bool
    {
        return $this->divider;
    }

    /**
     * Stores if this item is a divider.
     * @param bool $divider
     */
    private function setDivider(bool $divider = false)
    {
        $this->divider = $divider;
    }
}
