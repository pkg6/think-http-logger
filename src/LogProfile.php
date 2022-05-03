<?php

namespace whereof\think\HttpLogger;

use think\Request;

interface LogProfile
{
    /**
     * @param Request $request
     * @return bool
     */
    public function shouldLogRequest(Request $request): bool;

}