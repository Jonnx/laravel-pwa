{{-- resources/views/components/pwa/install-banner.blade.php --}}
<div x-data="pwaInstallBanner" x-show="show" class="bg-green-600 text-white px-4 py-3 flex items-center justify-between z-50 shadow-lg">
    <span>
        <strong>Install this app</strong> for a better experience!
    </span>
    <button
        @click="promptInstall"
        class="ml-4 bg-white text-green-600 font-semibold px-4 py-2 rounded shadow hover:bg-green-100 transition"
    >
        Install App
    </button>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pwaInstallBanner', () => ({
            show: false,
            deferredPrompt: null,
            init() {
                window.addEventListener('beforeinstallprompt', (e) => {
                    e.preventDefault();
                    this.deferredPrompt = e;
                    this.show = true;
                });
                window.addEventListener('appinstalled', () => {
                    this.show = false;
                });
                // Hide if already installed (standalone mode)
                if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
                    this.show = false;
                }
            },
            promptInstall() {
                if (this.deferredPrompt) {
                    this.deferredPrompt.prompt();
                    this.deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            this.show = false;
                        }
                        this.deferredPrompt = null;
                    });
                }
            }
        }));
    });
</script>
