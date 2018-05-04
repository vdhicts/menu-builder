<?php

namespace Vdhicts\Dicms\Menu\Exceptions;

use Throwable;

class InvalidLinkException extends MenuException
{
    /**
     * InvalidLinkException constructor.
     * @param string $link
     * @param Throwable|null $previous
     */
    public function __construct($link, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Provided link "%s" should be a valid URL or null', $link),
            0,
            $previous
        );
    }
}
