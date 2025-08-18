<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $title ?? 'Admin Panel' }} - MyBlog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    {{-- Tambahan untuk Tom-Select --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    
    <style>
        /* Styling tambahan jika diperlukan */
        .ti { font-size: 1.25rem; }
    </style>
</head>
<body>
    <div class="page">
        @include('admin.partials._sidebar')

        <div class="page-wrapper">
            @yield('header')

            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="#" class="link-secondary">Documentation</a></li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">License</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ date('Y') }}
                                    <a href="." class="link-secondary">AdminPanel</a>.
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js" defer></script>
    
    {{-- JS untuk Tom-Select & TinyMCE --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    {{-- INI YANG BARU DENGAN API KEY ANDA --}}
    <script src="https://cdn.tiny.cloud/1/9im15an3tedjirh961zoe09vst3o1m0e934tt4skutla7su1/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

    @stack('scripts')

</body>
</html>