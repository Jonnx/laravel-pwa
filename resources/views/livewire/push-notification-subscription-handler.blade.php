{{-- resources/views/livewire/push-notification-subscription-handler.blade.php --}}
<div x-data="pushNotificationSubscriptionHandler">
    <!-- Livewire logic for push notification subscription goes here -->
    <p>Push Notification Subscription Handler Component Loaded.</p>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pushNotificationSubscriptionHandler', () => ({
            debug: {{ $debug ? 'true' : 'false' }},
             log(message) {
                if (this.debug) {
                    console.log(message);
                }
            },
            init() {
                this.log('Push Notification Subscription Handler Initialized');
                this.checkSubscription(false);
            },
           
            checkSubscription(userInitiated = false) {
                // Logic to ask for push notification permission
                this.log('Push Notification Subscription: Check Permission Started', { userInitiated });

                const serviceWorker = navigator.serviceWorker;
                serviceWorker.ready.then(registration => {
                    registration.pushManager.getSubscription().then(subscription => {
                        if (subscription) {
                            this.log('Push Notification Subscription: Already Subscribed', { subscription });
                            this.updateSubscriptionOnServer(subscription);
                        } else {
                            this.log('Push Notification Subscription: Not Subscribed');
                            if (userInitiated) {
                                this.log('Push Notification Subscription: Requesting Permission and Subscribing User');
                                this.requestPermissionAndSubscribe(registration);
                            }
                        }
                    });
                });
            },
            updateSubscriptionOnServer(subscription) {
                // Send subscription to server via Livewire
                this.log('Push Notification Subscription: Sending Subscription to Server', { subscription });
                @this.call('upsertSubscription', subscription);
            },
        }));
    });
</script>
{{-- end of livewire/push-notification-subscription-handler --}}
