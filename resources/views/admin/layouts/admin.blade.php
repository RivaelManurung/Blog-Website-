<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Sisipkan config & link font seperti sebelumnya --}}
</head>
<body class="bg-slate-50">
    <div class="flex min-h-screen">
        @include('admin.partials._sidebar')
        <div class="flex-1 p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>