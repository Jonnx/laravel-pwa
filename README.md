# Laravel PWA Package

Turn your Laravel application into a Progressive Web App (PWA) with push notifications and more.

## Installation

1. **Install the package via Composer:**

```bash
composer require jonnx/laravel-pwa
```

2. **Publish the config and views:**

```bash
php artisan vendor:publish --provider="Jonnx\LaravelPwa\LaravelPwaServiceProvider"
```

> **Important:**
> To ensure Tailwind CSS and Vite pick up all classes used in the package's Blade files, you must publish the views. This copies them to your app's `resources/views/vendor/laravel-pwa/` directory, which is always scanned by Tailwind and Vite.

3. **Publish the CSS (optional, for custom styles):**

```bash
php artisan vendor:publish --tag=laravel-pwa-assets
```

4. **Add the published views to your Tailwind config:**

In your `tailwind.config.js`:

```js
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
  ],
  // ...other config
}
```

5. **Import the published CSS in your main CSS (if using):**

```css
@import 'vendor/laravel-pwa/pwa.css';
```

Or add the published CSS directly in your layout:

```blade
<link rel="stylesheet" href="{{ asset('vendor/laravel-pwa/pwa.css') }}">
```

6. **Restart your Vite dev server:**

```bash
npm run dev
# or
yarn dev
```

## Usage

- Add the PWA head and scripts to your layout:

```blade
@laravelPwaHead
@laravelPwaScripts
```

- Use the push notification banner component (after publishing views):

```blade
<x-pwa.push-notification-banner />
```

- Use the push notification subscription handler Livewire component:

```blade
@livewire('push-notification-subscription-handler')
```

## Push Notification Setup

To enable push notifications, you need to generate VAPID API keys:

```bash
php artisan webpush:vapid
```

This will generate the required keys and update your `.env` file. 

## PWA Install Banners

This package provides two install banners to help users install your PWA:

- `<x-pwa.install-banner />` — Displays a banner and prompts the user to install the app using the browser's native install prompt (supported in Chrome, Edge, and most Android browsers). The banner only appears if the app is not already installed and the browser supports the install prompt.

- `<x-pwa.install-banner-manual />` — Displays a banner with manual installation instructions for browsers that do not support the native install prompt (such as Safari on iOS and macOS). The banner automatically detects the user's platform and provides tailored instructions (e.g., "Add to Home Screen" for iOS, "Add to Dock" for macOS Safari).

Include these components in your layout to provide a seamless install experience for all users:

```blade
<x-pwa.install-banner />
<x-pwa.install-banner-manual />
```

## Notes
- Make sure your app is served over HTTPS for push notifications to work.
- If you use custom Blade components, register them in your app or extend the package as needed.
- For advanced configuration, check the published `config/pwa.php` file.

## Contributing

Contributions are welcome! To contribute to this package:

1. Fork the repository and create your branch from `main`.
2. Make your changes, following PSR standards and best practices.
3. Add or update tests as needed.
4. Submit a pull request with a clear description of your changes.

If you have ideas, feature requests, or find bugs, please open an issue.