<?php

namespace Jonnx\LaravelPwa;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as IlluminateNotification;
use NotificationChannels\WebPush\DeclarativeWebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class Notification extends IlluminateNotification
{
    use Queueable;

    public $title;
    public $body;
    public $openUrl;

    public function __construct(string|null $title = null, string|null $body = null, string|null $openUrl = null)
    {
        $this->title = trim($title);
        $this->body = trim($body);
        $this->openUrl = trim($openUrl);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $notification = (new DeclarativeWebPushMessage);
        if($this->title) {
            $notification->title($this->title);
        }
        if($this->body) {
            $notification->body($this->body);
        }
        if($this->openUrl) {
            $notification->navigate($this->openUrl)
                ->data(['url_open' => $this->openUrl]);
        }

        return $notification;
    }
}
