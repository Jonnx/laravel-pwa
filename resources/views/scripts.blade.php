{{-- resources/views/scripts.blade.php --}}
<!-- PWA Scripts Section -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('{{ route('pwa.service-worker') }}');
        });
    }
</script>
