<?php

namespace tp5er\think\HttpLogger;

use think\Request;

class Manager
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
     * @var Request
     */
    protected $request;

    /**
     * HttpLogger constructor.
     * @param LogProfile $logProfile
     * @param LogWriter $logWriter
     */
    public function __construct(LogProfile $logProfile, LogWriter $logWriter, Request $request = null)
    {
        $this->logProfile = $logProfile;
        $this->logWriter  = $logWriter;
        $this->request    = $request;
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return void
     */
    public function record()
    {
        if ($this->logProfile->shouldLogRequest($this->request)) {
            $this->logWriter->logRequest($this->request);
        }
    }
}
