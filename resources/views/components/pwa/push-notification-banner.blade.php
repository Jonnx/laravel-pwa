{{-- resources/views/components/push-notification-banner.blade.php --}}
<div x-data="{ show: true }" x-show="show" class="fixed bottom-0 left-0 right-0 bg-blue-600 text-white px-4 py-3 flex items-center justify-between z-50 shadow-lg">
    <span>
        <strong>Enable push notifications</strong> to stay updated!
    </span>
    <button
        @click="show = false; $dispatch('trigger-push-permission')"
        class="ml-4 bg-white text-blue-600 font-semibold px-4 py-2 rounded shadow hover:bg-blue-100 transition"
    >
        Enable Push Notifications
    </button>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pushNotificationBanner', () => ({
            // You can add more logic here if needed
        }));
    });
</script>
