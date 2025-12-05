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
                this.log('Push Notification Subscription Permission Requested', { userInitiated });
            }
        }));
    });
</script>
{{-- end of livewire/push-notification-subscription-handler --}}
