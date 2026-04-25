async function updateBadge() {
    if (!self.navigator.setAppBadge) return;
    try {
        const notifications = await self.registration.getNotifications();
        const count = notifications.length;
        if (count > 0) {
            self.navigator.setAppBadge(count);
        } else if (self.navigator.clearAppBadge) {
            self.navigator.clearAppBadge();
        }
    } catch (e) {
        // Best-effort: if anything goes wrong, fall back to a generic indicator
        // so the user at least sees that something happened.
        try { self.navigator.setAppBadge(1); } catch (_) {}
    }
}

self.addEventListener('push', (event) => {
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

        // Set the app icon badge to the count of currently-displayed
        // notifications. Calling setAppBadge() with no argument leaves the
        // count off (Android shows just a dot, iOS may show nothing at all);
        // passing an explicit integer is required for the count to render.
        await updateBadge();

        if (typeof __LARAVEL_PWA_BROADCAST_PUSH__ !== 'undefined' && __LARAVEL_PWA_BROADCAST_PUSH__) {
            const clients = await self.clients.matchAll({ type: 'window', includeUncontrolled: true });
            for (const c of clients) {
                c.postMessage({ type: 'pwa:push', payload: payload });
            }
        }
    })());
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();

    const url = event.notification.data && event.notification.data.url_open;

    event.waitUntil((async () => {
        // Recount after the click; clearing only when the last notification
        // is gone so multi-notification stacks decrement properly.
        await updateBadge();

        if (!url) return;

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

// Recount when individual notifications are dismissed by the user (Android),
// so the badge reflects what's actually still in the tray.
self.addEventListener('notificationclose', function (event) {
    event.waitUntil(updateBadge());
});
