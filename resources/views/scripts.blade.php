<!-- SERVICE WORKER -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('{{ route('pwa.service-worker') }}');
        });
    }
</script>

@if(config('pwa.features.push_notifications.enabled'))
    {{-- Include Livewire Push Notification Subscription Handler --}}
    @livewire('push-notification-subscription-handler')
@endif