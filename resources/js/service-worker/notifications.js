self.addEventListener('push', (event) => {
    self.navigator.setAppBadge && self.navigator.setAppBadge();

    var payload = {
        title: 'Heads up!',
        body: 'We have news for you!',
    };
    try {
        // JSON PARSE PAYLOAD
        payload = JSON.parse(event.data.text());

        // support for declarative notifications
        if (payload.notification) {
            payload = payload.notification;
        }
    } catch (error) {
        payload.body = event.data.text();
    }

    event.waitUntil((async () => {
        await self.registration.showNotification(payload.title, payload);

        if (typeof __LARAVEL_PWA_BROADCAST_PUSH__ !== 'undefined' && __LARAVEL_PWA_BROADCAST_PUSH__) {
            const clients = await self.clients.matchAll({ type: 'window', includeUncontrolled: true });
            for (const c of clients) {
                c.postMessage({ type: 'pwa:push', payload: payload });
            }
        }
    })());
});

self.addEventListener('notificationclick', function (event) {
    self.navigator.clearAppBadge && self.navigator.clearAppBadge();
    event.notification.close();

    const url = event.notification.data && event.notification.data.url_open;
    if (!url) return;

    event.waitUntil((async () => {
        const target = new URL(url, self.location.origin).href;
        const clients = await self.clients.matchAll({ type: 'window', includeUncontrolled: true });

        if (clients.length > 0) {
            const c = clients[0];
            await c.focus();
            if ('navigate' in c) await c.navigate(target);
            return;
        }

        if (self.clients.openWindow) {
            await self.clients.openWindow(target);
        }
    })());
});
