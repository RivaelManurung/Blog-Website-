<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Your Name - Personal Blog' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    {{-- Sisipkan config & link font seperti sebelumnya --}}
</head>
<body class="bg-white text-slate-800">
    @include('user.components.navbar')
    <main>
        @yield('content')
    </main>
    @include('user.components.footer')
</body>
</html>