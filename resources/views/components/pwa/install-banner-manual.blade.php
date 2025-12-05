{{-- resources/views/components/pwa/install-banner-manual.blade.php --}}
<div x-cloak x-data="manualInstallBanner" x-show="show" class="bg-yellow-600 text-white px-4 py-3 flex items-center justify-between shadow-lg">
    <span>
        <div class="mb-1"><strong>Install this app manually</strong> for a better experience!</div>
        <template x-if="isIos()">
            <span class="ml-2">Tap <span class="font-bold">Share</span> <svg class="inline w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12v.01M12 4v16m8-8v.01M16 8l-4-4-4 4"/></svg> then <span class="font-bold">Add to Home Screen</span>.</span>
        </template>
        <template x-if="isMacSafari()">
            <span class="ml-2">In Safari, go to <span class="font-bold">File &gt; Add to Dock</span>.</span>
        </template>
    </span>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('manualInstallBanner', () => ({
            show: false,
            init() {
                // Only show if not installed and no install prompt is available
                if (!this.isInstalled() && !this.hasInstallPrompt()) {
                    this.show = true;
                }
            },
            isInstalled() {
                return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
            },
            hasInstallPrompt() {
                // Chrome/Edge/Android support beforeinstallprompt
                return 'onbeforeinstallprompt' in window;
            },
            isIos() {
                return /iphone|ipad|ipod/i.test(navigator.userAgent);
            },
            isMacSafari() {
                return /Macintosh/i.test(navigator.userAgent) && /Safari/i.test(navigator.userAgent) && !/Chrome/i.test(navigator.userAgent);
            }
        }));
    });
</script>
