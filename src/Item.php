<?php

namespace Vdhicts\Menu;

class Item
{
    /**
     * Id of the menu item.
     * @var mixed
     */
    private $id;

    /**
     * Name of the menu item.
     */
    private string $name;

    /**
     * The link the menu item should link to.
     */
    private ?string $link = null;

    /**
     * Parent id which the menu item belongs to.
     * @var mixed
     */
    private $parentId = null;

    /**
     * Determines if the menu item is a divider or not.
     */
    private bool $divider = false;

    /**
     * @param mixed $id
     * @param mixed $parentId
     * @throws Exceptions\InvalidLinkException
     */
    public function __construct($id, string $name, string $link = null, $parentId = null, bool $divider = false)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setLink($link);
        $this->setParentId($parentId);
        $this->setDivider($divider);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    private function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function hasLink(): bool
    {
        return ! is_null($this->getLink());
    }

    /**
     * @throws Exceptions\InvalidLinkException
     */
    private function setLink(string $link = null): self
    {
        if (! is_null($link) && ! filter_var($link, FILTER_VALIDATE_URL)) {
            throw new Exceptions\InvalidLinkException($link);
        }

        $this->link = $link;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    public function hasParent(): bool
    {
        return ! is_null($this->getParentId());
    }

    /**
     * @param mixed $parentId
     */
    private function setParentId($parentId = null): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function isDivider(): bool
    {
        return $this->divider;
    }

    private function setDivider(bool $divider = false): self
    {
        $this->divider = $divider;

        return $this;
    }
}
