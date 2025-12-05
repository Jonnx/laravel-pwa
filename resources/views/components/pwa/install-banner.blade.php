@props(['class' => ''])
<div x-cloak x-data="pwaInstallBanner" x-show="show" {{ $attributes->merge(['class' => 'bg-green-600 text-white px-4 py-3 flex items-center justify-between z-50 shadow-lg']) }}>
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
    // Listen for beforeinstallprompt globally and notify Alpine
    window.deferredPwaInstallPrompt = null;
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        window.deferredPwaInstallPrompt = e;
        window.dispatchEvent(new CustomEvent('pwa:show-install-banner'));
    });
</script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pwaInstallBanner', () => ({
            debug: {{ config('app.debug') ? 'true' : 'false' }},
            show: false,
            deferredPrompt: null,
            log(message) {
                if (this.debug) {
                    console.log(message);
                }
            },
            init() {
                this.log('PWA Install Banner: Initializing');

                window.addEventListener('pwa:show-install-banner', () => {
                    this.log('PWA Install Banner: Custom event received');
                    this.deferredPrompt = window.deferredPwaInstallPrompt;
                    this.show = true;
                });
                window.addEventListener('appinstalled', () => {
                    this.log('PWA Install Banner: App installed');
                    this.show = false;
                });
                // Hide if already installed (standalone mode)
                if (window.matchMedia('(display-mode: {{ config('pwa.manifest.display') }})').matches || window.navigator.{{ config('pwa.manifest.display') }} === true) {
                    this.log('PWA Install Banner: Already installed (standalone mode)');
                    this.show = false;
                }
            },
            promptInstall() {
                if (this.deferredPrompt) {
                    this.deferredPrompt.prompt();
                    this.deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            this.log('PWA Install Banner: User accepted install');
                            this.show = false;
                        }
                        else {
                            this.log('PWA Install Banner: User dismissed install');
                            this.show = false;
                        }
                        this.deferredPrompt = null;
                    });
                }
                else {
                    this.log('PWA Install Banner: No deferred prompt');
                }
            }
        }));
    });
</script>
