<?php

namespace Core\Component;

use Core\Abstracts\ApplicationComponent;
use Core\Contract\RouterInterface;

/**
 * Router
 */
class Router extends ApplicationComponent implements RouterInterface
{
    const KEY_CTRL = 'ctrl';
    const KEY_ACTION = 'action';

    const DEFAULT_CTRL = 'default';
    const DEFAULT_ACTION = 'index';

    function getController( ): string
    {
        $get = $this->getComponent('HttpRequest')->get();

        if(isset($get[self::KEY_CTRL]) && ctype_alpha($get[self::KEY_CTRL])) {
            return $get[self::KEY_CTRL];
        } else {
            return self::DEFAULT_CTRL;
        }
        return false;
    }

    function getAction(): string
    {
        $get = $this->getComponent('HttpRequest')->get();

        if(isset($get[self::KEY_ACTION])) {
            if(ctype_alpha($get[self::KEY_ACTION]))
                return $get[self::KEY_ACTION];
        } else {
            return self::DEFAULT_ACTION;
        }
        return self::DEFAULT_ACTION;
    }
}