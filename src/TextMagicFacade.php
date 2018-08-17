<?php

namespace CloudLink\TextMagic;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CloudLink\TextMagic\TextMagic
 */
class TextMagicFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TextMagic';
    }
}
