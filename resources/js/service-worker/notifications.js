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