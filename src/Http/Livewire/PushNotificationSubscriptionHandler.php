<?php

namespace Jonnx\LaravelPwa\Http\Livewire;

use Livewire\Component;

class PushNotificationSubscriptionHandler extends Component
{
    public $debug;
    
    public function mount()
    {
        $this->debug = config('app.debug', false);
    }

    public function render()
    {
        return view('pwa::livewire.push-notification-subscription-handler');
    }

    public function upsertSubscription($subscription)
    {
        $user = request()->user();
        if(!$user) {
            return;
        }

        $user->updatePushSubscription(
            endpoint: data_get($subscription, 'endpoint'),
            key: data_get($subscription, 'keys.p256dh'),
            token: data_get($subscription, 'keys.auth'),
            contentEncoding: 'aes128gcm',
        );
    }
}
