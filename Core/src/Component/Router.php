<?php

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Contract\RouterInterface;

/**
 * Router
 */
class Router extends ApplicationComponent implements RouterInterface
{
    const KEY_CTRL = 'ctrl';
    const KEY_ACTION = 'action';
    const KEY_MODULE = 'module';

    const DEFAULT_CTRL = 'default';
    const DEFAULT_ACTION = 'index';
    const DEFAULT_MODULE = 'app';

    function getModule( ): string
    {
        return $this->_getKey(self::KEY_MODULE, self::DEFAULT_MODULE);
    }

    function getController( ): string
    {
        return $this->_getKey(self::KEY_CTRL, self::DEFAULT_CTRL);
    }

    function getAction(): string
    {
        return $this->_getKey(self::KEY_ACTION, self::DEFAULT_ACTION);
    }

    private function _getKey(string $key, string $defaultKey)
    {
        $get = $this->httpRequest->get();

        if (isset($get[$key])) {
            if (ctype_alpha($get[$key])) {
                return $get[$key];
            }
        }
        return $defaultKey;
    }
}
