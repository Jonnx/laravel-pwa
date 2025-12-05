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

## Notes
- Make sure your app is served over HTTPS for push notifications to work.
- If you use custom Blade components, register them in your app or extend the package as needed.
- For advanced configuration, check the published `config/pwa.php` file.

---

For more details, see the package documentation or open an issue if you need help.
