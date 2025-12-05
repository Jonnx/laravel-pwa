self.addEventListener('push', (event) => {
    self.navigator.setAppBadge();
    
    var payload = {
        title: 'Heads up!',
        body: 'We have news for you!',
    };
    try {
        // JSON PARSE PAYLOAD
        payload = JSON.parse(event.data.text());

        // support for declarative notifications
        if(payload.notification) {
            payload = payload.notification;
        }
    } 
    catch(error) {
        payload.body = event.data.text();
    }

    self.registration.showNotification(payload.title, payload);
});

self.addEventListener('notificationclick', function(event) {
    self.navigator.clearAppBadge();

    // DEBUG: log event and notification
    // console.log(event);
    // console.log(event.notification);

    // dismiss notification when clicked
    event.notification.close();


    // check notification data
    if(event.notification.data) {
        if(event.notification.data.url_open) {
            event.waitUntil(
                (async () => {
                    const clients = await self.clients.matchAll();                    
                    if(clients.length > 0) {
                        clients[0].navigate(event.notification.data.url_open);
                        clients[0].focus();
                    }
                })()
            );
        }
    }
});