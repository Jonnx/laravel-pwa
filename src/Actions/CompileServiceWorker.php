<?php

namespace Jonnx\LaravelPwa\Actions;

class CompileServiceWorker
{
    public static function compile()
    {
        $workerContents = '';
        $offlineSupport = config('pwa.features.offline_support', false);
        $notificationsSupport = config('pwa.features.notifications', false);

        if($offlineSupport) {
            $workerContents .= file_get_contents(__DIR__.'/../../resources/js/service-worker/offline.js');
            $workerContents .= "\n\n";
        }

        if($notificationsSupport) {
            $workerContents .= file_get_contents(__DIR__.'/../../resources/js/service-worker/notifications.js');
            $workerContents .= "\n\n";
        }

    }
}