<?php

namespace tp5er\think\HttpLogger\Facade;

use tp5er\think\HttpLogger\Manager;

/**
 * Class HttpRecord
 * @author zhiqiang
 * @package tp5er\think\HttpLogger\Facade
 * @mixin Manager
 */
class HttpRecord extends \think\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeClass()
    {
        return Manager::class;
    }
}
