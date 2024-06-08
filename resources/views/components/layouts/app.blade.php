<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700" rel="stylesheet" />

    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Cropper.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />

    {{-- TinyMCE --}}
    {{-- <script src="https://cdn.tiny.cloud/1/fuq9e9kvmq3912uqd35vzhh3nhc3inu9zpbhoe7uf2wuuy1c/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}

    {{-- EasyMDE --}}
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

    {{-- Chart.js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-inter antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>

        {{-- SIDEBAR --}}
        @if(auth()->user())
        <x-slot:sidebar drawer="main-drawer" class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-4 pt-3" />

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />
                    <x-list-item :item="$user" link="/cp/user/profile" value="name" sub-value="branch.name" no-separator class="-mx-2 !-my-2 rounded">
                        <x-slot:avatar>
                            <x-avatar image="{{ $user->avatar ?? asset('assets/img/default-avatar.png') }}" class="!w-10" />
                        </x-slot:avatar>
                        <x-slot:actions>
                            <x-dropdown>
                                <x-slot:trigger>
                                    <x-button icon="o-cog-6-tooth" class="btn-circle btn-ghost btn-sm" />
                                </x-slot:trigger>
                                <x-menu-item title="My profile" icon="o-user" link="/cp/user/profile" />
                                <x-menu-item title="Change Theme" icon="o-swatch" @click="$dispatch('mary-toggle-theme')" />
                                <x-menu-item title="Log Out" icon="o-power" no-wire-navigate link="/logout" />
                            </x-dropdown>
                        </x-slot:actions>
                    </x-list-item>
                    <x-menu-separator />
                @endif

                <x-menu-item title="Home" icon="o-sparkles" link="/cp/" />
                <x-menu-item title="Posts" icon="o-cube" link="/cp/posts" />
                <x-menu-item title="Tags" icon="o-hashtag" link="/cp/tags" />

                @can('admin')
                <x-menu-sub title="Setup" icon="o-cog-6-tooth">
                    <x-menu-item title="Users" link="/cp/users" />
                </x-menu-sub>
                @endcan

                <x-menu-separator />
                <x-menu-item icon="o-magnifying-glass" @click.stop="$dispatch('mary-search-open')">
                    Search <x-badge value="Cmd + G" class="badge-ghost" />
                </x-menu-item>
            </x-menu>
        </x-slot:sidebar>
        @endif

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast position="toast-bottom toast-right" />

    {{-- Spotlight --}}
    <x-spotlight />

    {{-- Theme toggle --}}
    <x-theme-toggle class="hidden" />

    @livewireScriptConfig
</body>
</html>
