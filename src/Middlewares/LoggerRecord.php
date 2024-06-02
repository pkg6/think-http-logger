<?php

namespace tp5er\think\HttpLogger\Middlewares;

use Closure;
use think\Request;
use think\Response;
use tp5er\think\HttpLogger\Manager;

class LoggerRecord
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * 处理请求
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        $this->manager->setRequest($request);
        $this->manager->record();
        return $next($request);

    }
}
