<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Service-Hub')</title>

    <style>
        html {
            visibility: hidden;
        }

        html.page-ready {
            visibility: visible;
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="32x32"
      href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16"
      href="{{ asset('favicon-16x16.png') }}">
<link rel="apple-touch-icon"
      href="{{ asset('apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<meta name="theme-color" content="#0f2744">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
        rel="stylesheet"
        href="{{ asset('css/header.css') }}">

    <style>
        :root {
            --sh-font-body: 'Inter', sans-serif;
            --sh-font-heading: 'Manrope', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: var(--sh-font-body);
            color: #1f2937;
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .site-main {
            margin-top: 80px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--sh-font-heading);
            font-weight: 700;
        }

        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }

        a {
            text-decoration: none;
        }

        img {
            max-width: 100%;
        }
    </style>

</head>

<body>

    @include('components.header')

    <main class="site-main">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('styles')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

    <script>
        document.documentElement.classList.add('page-ready');
    </script>

</body>

</html>