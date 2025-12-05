<?php

namespace Jonnx\LaravelPwa\View\Components;

use Illuminate\View\Component;

class PushNotificationSubscriptionHandler extends Component
{
    public $debug;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
        $this->debug = config('app.debug', false);
    }
	
	/**
	 * Get the view / contents that represent the component.
	 */
	public function render()
	{
		return view('pwa::components.push-notification-subscription-handler');
	}
}
