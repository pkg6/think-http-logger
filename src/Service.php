<?php


namespace tp5er\think\HttpLogger;

use tp5er\think\HttpLogger\LogProfile\LogNonGetRequests;
use tp5er\think\HttpLogger\LogWriter\DefaultLogWriter;
use tp5er\think\HttpLogger\Middlewares\HttpLogger;

class Service extends \think\Service
{
    public function register()
    {

        $this->app->bind(LogProfile::class, function () {
            $class = $this->app->config->get('http-logger.log_profile', LogNonGetRequests::class);
            return new $class($this->app);
        });
        $this->app->bind(LogWriter::class, function () {
            $class = $this->app->config->get('http-logger.log_writer', DefaultLogWriter::class);
            return new $class($this->app);
        });
        $this->app->bind(Manager::class, function () {
            return new Manager(
                $this->app->get(LogProfile::class),
                $this->app->get(LogWriter::class),
                $this->app->request
            );
        });

        /**
         * @deprecated
         */
        $this->app->bind(HttpLogger::class, function () {
            return new HttpLogger($this->app->get(LogProfile::class), $this->app->get(LogWriter::class));
        });
    }
}
