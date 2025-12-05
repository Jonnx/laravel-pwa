<?php

namespace Jonnx\LaravelPwa\Http\Livewire;

use Livewire\Component;
use Jonnx\LaravelPwa\Notification;;

class PushNotificationTestButton extends Component
{
    public $debug;
    
    public function mount()
    {
        $this->debug = config('app.debug', false);
    }

    public function render()
    {
        return view('pwa::livewire.push-notification-test-button');
    }

    public function sendTestNotification()
    {
        $user = request()->user();
        if(!$user) {
            return;
        }

        $user->notify(new Notification(
            title: 'Test Push Notification',
            body: 'This is a test push notification from Laravel PWA package. Clicking it will take you to the settings page.',
            openUrl: url('/settings')
        ));
    }
}
