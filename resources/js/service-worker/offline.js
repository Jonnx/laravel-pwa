var CACHE_NAME = "offline-cache-v1";
var OFFLINE_URL = '/pwa/offline';

var filesToCache = [
    OFFLINE_URL
];

self.addEventListener("install", (event) => {
    // Take over as soon as the new SW finishes installing so the current
    // page lifecycle becomes controlled without needing a reload. Required
    // for Chromium's install-criteria check (and therefore the
    // `beforeinstallprompt` event) to succeed on a first-visit session.
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(filesToCache))
    );
});

self.addEventListener("fetch", (event) => {
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .catch(() => {
                    return caches.match(OFFLINE_URL);
                })
        );
    } else {
        event.respondWith(
            caches.match(event.request)
                .then((response) => {
                    return response || fetch(event.request);
                })
        );
    }
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        Promise.all([
            // Claim existing clients so this SW controls the tab that
            // registered it. Without claim, Chromium treats the tab as
            // "not controlled by a service worker" until the next full
            // navigation — which blocks install criteria evaluation and
            // keeps `beforeinstallprompt` from firing during first-visit
            // SPA sessions.
            self.clients.claim(),
            caches.keys().then((cacheNames) => {
                return Promise.all(
                    cacheNames.map((cacheName) => {
                        if (cacheName !== CACHE_NAME) {
                            return caches.delete(cacheName);
                        }
                    })
                );
            }),
        ])
    );
});