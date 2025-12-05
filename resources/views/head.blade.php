{{-- resources/views/head.blade.php --}}
<!-- PWA Head Section -->
<link rel="manifest" href="{{ route('pwa.manifest') }}">
<meta name="theme-color" media="(prefers-color-scheme: light)" content="{{ config('pwa.theme_colors.light', config('pwa.manifest.theme_color')) }}">
<meta name="theme-color" media="(prefers-color-scheme: dark)" content="{{ config('pwa.theme_colors.dark', config('pwa.manifest.theme_color')) }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<!-- Add more meta tags or links as needed -->
