<!-- SERVICE WORKER -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('{{ route('pwa.service-worker') }}');
        });
    }
</script>

@livewire('push-notification-subscription-handler')