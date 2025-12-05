{{-- resources/views/components/push-notification-banner.blade.php --}}
<div x-data="pwaPushNotificationBanner" x-show="show" class="bg-blue-600 text-white px-4 py-3 flex items-center justify-between z-50 shadow-lg">
    <span>
        <strong>Enable notifications</strong> to stay updated!
    </span>
    <button
        @click="enableNotifications"
        class="ml-4 bg-white text-blue-600 font-semibold px-4 py-2 rounded shadow hover:bg-blue-100 transition"
    >
        Enable Notifications
    </button>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pwaPushNotificationBanner', () => ({
            show: true,
            enableNotifications() {
                this.show = false;
                window.dispatchEvent(new CustomEvent('pwa:enable-push-notifications'));
            }
        }));
    });
</script>
