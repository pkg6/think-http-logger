<?php

declare (strict_types = 1);

namespace whereof\think\HttpLogger\Middlewares;

use Closure;
use think\Request;
use think\Response;
use whereof\think\HttpLogger\LogProfile;
use whereof\think\HttpLogger\LogWriter;


class HttpLogger
{
    /**
     * @var LogProfile
     */
    protected $logProfile;

    /**
     * @var LogWriter
     */
    protected $logWriter;

    /**
     * HttpLogger constructor.
     * @param LogProfile $logProfile
     * @param LogWriter $logWriter
     */
    public function __construct(LogProfile $logProfile, LogWriter $logWriter)
    {
        $this->logProfile = $logProfile;
        $this->logWriter  = $logWriter;
    }

    /**
     * 处理请求
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        if ($this->logProfile->shouldLogRequest($request)) {
            $this->logWriter->logRequest($request);
        }
        return $next($request);
    }
}