# Laravel PWA Package

Turn your Laravel application into a Progressive Web App (PWA) with push notifications and more.

## Dependencies


## Installation

1. **Install the package via Composer:**

```bash
composer require jonnx/laravel-pwa
```

2. Add Push Subscription Trait to User Model

```
use NotificationChannels\WebPush\HasPushSubscriptions;
...
class User extends Authenticatable
{
    use HasPushSubscriptions
```

3. **Publish the config and components:**

```bash
php artisan vendor:publish --force --tag=laravel-pwa-config
php artisan vendor:publish --force --tag=laravel-pwa-components
php artisan webpush:vapid
php artisan migrate
```

## Usage

- Add the PWA head and scripts to your layout:

```blade
@laravelPwaHead
@laravelPwaScripts
```

### PWA Install Banners

This package provides two install banners to help users install your PWA:

- `<x-pwa.install-banner />` — Displays a banner and prompts the user to install the app using the browser's native install prompt (supported in Chrome, Edge, and most Android browsers). The banner only appears if the app is not already installed and the browser supports the install prompt.

- `<x-pwa.install-banner-manual />` — Displays a banner with manual installation instructions for browsers that do not support the native install prompt (such as Safari on iOS and macOS). The banner automatically detects the user's platform and provides tailored instructions (e.g., "Add to Home Screen" for iOS, "Add to Dock" for macOS Safari).

Include these components in your layout to provide a seamless install experience for all users:

```blade
<x-pwa.install-banner />
<x-pwa.install-banner-manual />
```

### Push Notification Setup

#### Vapid Keys
To enable push notifications, you need to generate VAPID API keys:

```bash
php artisan webpush:vapid
```

This will generate the required keys and update your `.env` and `config/pwa.php` files. Make sure to configure your environment and PWA settings accordingly.

#### User Model Push Subscription Trait
This trait automatically establishes the relationship from the user model to many push subscriptions. This way a user can opt-in to push notifications on multiple devices and receive notifications everywhere. 

```
use NotificationChannels\WebPush\HasPushSubscriptions;
...
class User extends Authenticatable
{
    use HasPushSubscriptions
```

#### Web Push Subscription Handler
Use the push notification subscription handler Livewire component. This captures the subscription data and automatically saves it to the user on the back-end so that you can use the subscription to send notifications anytime. 
```blade
@livewire('push-notification-subscription-handler')
```

#### User Permission Banner
Push notifications require active user opt-in on all browsers. Include this components in your layout to provide a seamless opt-in experience.

```blade
<x-pwa.push-notification-banner />
```

## Customizing Banner Components
The setup steps publish the banner components to a folder in your project so you can easily tweak appearance, position and more. 
The files are located in the `resources/views/pwa` folder.

## Major Library Dependencies

| Library                              | Purpose                                                                                   |
|--------------------------------------|-------------------------------------------------------------------------------------------|
| [laravel/webpush](https://github.com/web-push-libs/laravel-web-push) | Handles browser push notifications, VAPID key management, and subscription storage.        |
| [livewire/livewire](https://laravel-livewire.com/) | Enables reactive components for subscription handling and real-time UI updates.            |
| [alpinejs](https://alpinejs.dev/)    | Provides lightweight frontend interactivity for banners and install prompts.               |
| [notification-channels/webpush](https://github.com/laravel-notification-channels/webpush) | Adds push notification support to Laravel's notification system.                           |

These libraries are required to:
- Manage push notification subscriptions and permissions.
- Provide real-time, interactive UI components for banners and prompts.
- Integrate with browser APIs for PWA installation and notifications.

---

For more details, see the package documentation or open an issue if you need help.

## Contributing

Contributions are welcome! To contribute to this package:

1. Fork the repository and create your branch from `main`.
2. Make your changes, following PSR standards and best practices.
3. Add or update tests as needed.
4. Submit a pull request with a clear description of your changes.

If you have ideas, feature requests, or find bugs, please open an issue.