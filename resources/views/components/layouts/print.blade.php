<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
        * { margin:0; }
        html, body { margin:0; padding:0; font-size:12px; font-family:Figtree,Helvetica,Arial,Verdana; }
        @page { margin: 0.5cm 1.5cm; padding:20px; }
        @media print{
            .no-print, .no-print *{
                display: none !important;
            }
        }
        .table td { font-size:12px; }
        .table-print { width:100%; border-spacing: 0; border-collapse:collapse !important; }
        .table-print tr th { padding:10px 5px; font-weight:bold; border:1px solid #000000; vertical-align:middle !important; text-align:center; }
        .table-print tr td { padding:4px 5px; border-right:1px solid #000000; border-left:1px solid #000000; }
        .table-print tr.border-top td { border-top:1px solid #000000; }
        .table-print tr.border-bottom td { border-bottom:1px solid #000000; }
        .yl { background:#FFFF80; }
        .border-top { border-top:1px solid #000000; }
        .border-bottom { border-bottom:1px solid #000000; }
        .border-right { border-right:1px solid #000000; }
        .border-left { border-left:1px solid #000000; }
        .text-center { text-align:center; }
        .valign-top { vertical-align:top; }
        .w-full { width:100%; }
        .h-40 { height:40px; }
        .h-60 { height:60px; }
        .p-10 { padding:10px; }
        .pt-20 { padding-top:20px; }
        .py-4 { padding-top:4px; padding-bottom:4px; }
        .py-10 { padding-top:10px; padding-bottom:10px; }
        .page-break { page-break-after: always; }
        .text-bold { font-weight:bold; }
        .text-16 { font-size:16px; }
        .text-20 { font-size:20px; }
        p { font-size:12px; }
        </style>

        <!-- Scripts -->
        @stack('head')
    </head>
    <body class="font-sans antialiased">
        {{ $slot }}
    </body>
</html>
