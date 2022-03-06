<?php

namespace Vdhicts\Menu\Exceptions;

use Throwable;

class InvalidLinkException extends MenuException
{
    public function __construct(string $link, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Provided link "%s" should be a valid URL or null', $link),
            0,
            $previous
        );
    }
}
