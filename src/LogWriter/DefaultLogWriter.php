<?php

namespace tp5er\think\HttpLogger\LogWriter;

use think\facade\Log;
use think\file\UploadedFile;
use think\Request;
use tp5er\think\HttpLogger\LogWriter;


class DefaultLogWriter extends WriterAbstract
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function logRequest(Request $request)
    {
        $message = $this->formatMessage($this->getMessage($request));
        Log::channel(config('http-logger.log_channel'))->info($message);
    }
    /**
     * @param Request $request
     * @return array
     */
    public function getMessage(Request $request)
    {
        $files = $this->files($request->file());
        return [
            'client_ip' => $request->ip(),
            'method'  => strtoupper($request->method()),
            'uri'     => $request->pathinfo(),
            'body'    => $request->all(),
            'headers' => $request->header(),
            'files'   => $files,
        ];
    }
    /**
     * @param array $message
     * @return string
     */
    protected function formatMessage(array $message)
    {
        $clientIpAsJson = json_encode($message['client_ip']);
        $bodyAsJson     = json_encode($message['body']);
        $headersAsJson  = json_encode($message['headers']);
        $files          = implode(',', $message['files']);
        return "{$message['method']} {$message['uri']} - Ip: {$clientIpAsJson}- Body: {$bodyAsJson} - Headers: {$headersAsJson} - Files: " . $files;
    }
}
