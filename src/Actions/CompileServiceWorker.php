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
            $broadcast = config('pwa.features.notifications_broadcast', true) ? 'true' : 'false';
            $workerContents .= "const __LARAVEL_PWA_BROADCAST_PUSH__ = {$broadcast};\n\n";
            $workerContents .= file_get_contents(__DIR__.'/../../resources/js/service-worker/notifications.js');
            $workerContents .= "\n\n";
        }

        return $workerContents;
    }
}