<?php

namespace Jonnx\LaravelPwa\Actions;

class CompileManifest
{
    public static function compile()
    {
        $manifest = config('pwa.manifest', []);
        return $manifest;
    }
}