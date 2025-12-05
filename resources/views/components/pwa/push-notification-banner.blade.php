{{-- resources/views/components/push-notification-banner.blade.php --}}
<div x-data="pushNotificationBanner" x-show="show" class="bg-blue-600 text-white px-4 py-3 flex items-center justify-between z-50 shadow-lg">
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
        Alpine.data('pushNotificationBanner', () => ({
            show: true,
            init() {
                if (!this.pushNotificationsPossible() || this.pushPermissionState() !== 'default') {
                    this.show = false;
                }
            },
            pushNotificationsPossible() {
                return 'Notification' in window && 'serviceWorker' in navigator;
            },
            pushPermissionState() {
                if ('Notification' in window && Notification.permission) {
                    return Notification.permission; // 'granted', 'denied', or 'default'
                }
                return 'default';
            },
            enableNotifications() {
                this.show = false;
                window.dispatchEvent(new CustomEvent('pwa-enable-push-notifications'));
            }
        }));
    });
</script>
