<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

new
#[Layout('components.layouts.empty')]
#[Title('Login')]
class extends Component {

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    #[Rule('nullable')]
    public bool $remember = false;

    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/');
        }
    }

    public function login()
    {
        $credentials = $this->validate();

        if (auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 'active'], $this->remember)) {

            request()->session()->regenerate();

            return redirect()->intended('/');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }
}; ?>
<div>
    <div class="mx-auto w-96">
        <div class="mb-10 flex justify-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/login.png') }}" alt="">
            </a>
        </div>

        <x-form wire:submit="login">
            <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
            <x-input label="Password" wire:model="password" type="password" icon="o-key" inline />

            <x-slot:actions>
                {{-- <x-button label="Create an account" class="btn-ghost" link="/register" /> --}}
                <x-checkbox label="Remember me" wire:model="remember" />
                <x-button label="Login" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="login" />
            </x-slot:actions>
        </x-form>
    </div>
</div>
