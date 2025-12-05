<!-- SERVICE WORKER -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('{{ route('pwa.service-worker') }}');
        });
    }
</script>

@if(config('pwa.features.notifications'))
    {{-- Include Livewire Push Notification Subscription Handler --}}
    @livewire('push-notification-subscription-handler')
@else
    <!-- Push Notifications feature is disabled in configuration -->
@endif