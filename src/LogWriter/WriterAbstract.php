<?php

namespace tp5er\think\HttpLogger\LogWriter;

use think\App;
use think\file\UploadedFile;
use think\Request;
use tp5er\think\HttpLogger\LogWriter;

abstract class WriterAbstract implements LogWriter
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param $files
     * @return array
     */
    public function files($files)
    {
        if (empty($files)) {
            return [];
        }
        $fs = $this->flatFiles($files);
        $fi = [];
        foreach ($fs as $f) {
            if (is_array($f)) {
                $fi = array_merge($fi, $f);
            } else {
                $fi[] = $f;
            }
        }
        return $fi;
    }

    /**
     * @param $file
     * @return array|string
     */
    public function flatFiles($file)
    {
        if ($file instanceof UploadedFile) {
            return $file->getOriginalName();
        }
        if (is_array($file)) {
            return array_map([$this, 'flatFiles'], $file);
        }
        return (string)$file;
    }
}
