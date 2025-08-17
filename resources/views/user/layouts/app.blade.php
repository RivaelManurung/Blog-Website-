<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Your Name - Personal Blog' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    
    {{-- 1. TAMBAHKAN SCRIPT ALPINE.JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Sisipkan config Tailwind & link font --}}
    <script> /* ... config tailwind Anda ... */ </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- 2. TAMBAHKAN CSS UNTUK BACKGROUND BARU --}}
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background-color: #f8fafc; /* bg-slate-50 */
            background-image: radial-gradient(circle at top left, #a5b4fc, transparent 40%),
                              radial-gradient(circle at bottom right, #a78bfa, transparent 40%);
        }
    </style>
</head>
{{-- 3. TERAPKAN CLASS BACKGROUND PADA BODY --}}
<body class="gradient-bg text-slate-800">

    @include('user.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('user.partials.footer')

</body>
</html>