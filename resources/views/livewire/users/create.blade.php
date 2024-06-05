<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mary\Traits\Toast;
use App\Enums\Role;
use App\Enums\ActiveStatus;
use App\Models\Store;
use App\Models\User;

new class extends Component {
    use Toast, WithFileUploads;

    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $avatar = '';
    public $store_id = '';
    public $role = Role::admin;
    public $status = ActiveStatus::active;
    public Collection $storeSearchable;

    public function mount(): void
    {
        $this->searchStore();
    }

    public function searchStore(string $value = ''): void
    {
        $selectedOption = Store::where('id', intval($this->store_id))->get();
        $this->storeSearchable = Store::query()
            ->where('name', 'like', "%$value%")
            ->active()
            ->take(20)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'avatar' => 'nullable|image|max:1024',
            'role' => 'required',
            'store_id' => '',
            'status' => 'required',
        ]);

        unset($data['avatar']);
        unset($data['password_confirmation']);

        if ($this->avatar) {
            $url = $this->avatar->store('avatar', 'public');
            $data['avatar'] =  "/storage/".$url;
        }

        $data['password'] = Hash::make($data['password']);
        $data['store_id'] = intval($data['store_id']);

        $user = User::create($data);

        $this->success('User has been created.', redirectTo: '/users');
    }
}; ?>

<div>
    <x-header title="Create New User" separator />
    <div class="lg:w-[70%]">
        <x-form wire:submit="save">
            <x-card>
                <div class="space-y-4">
                    <x-file label="Avatar" wire:model="avatar" accept="image/png, image/jpeg" crop-after-change>
                        <img src="{{ $user->avatar ?? asset('assets/img/default-avatar.png') }}" class="h-40 rounded-lg" />
                    </x-file>
                    <div class="space-y-4 lg:space-y-0 lg:grid grid-cols-2 gap-4">
                        <x-input label="Name" wire:model="name" />
                        <x-input label="Email" wire:model="email" />
                    </div>
                    <div class="space-y-4 lg:space-y-0 lg:grid grid-cols-2 gap-4">
                        <x-input label="Password" wire:model="password" type="password" />
                        <x-input label="Confirm Password" wire:model="password_confirmation" type="password" />
                    </div>
                    <x-choices label="Store" wire:model.live="store_id" :options="$storeSearchable" search-function="searchStore" option-label="name" single searchable />
                    <div class="space-y-4 lg:space-y-0 lg:grid grid-cols-2 gap-4">
                        <x-select label="Role" :options="\App\Enums\Role::toSelect()" wire:model="role" />
                        <x-select label="Status" :options="\App\Enums\ActiveStatus::toSelect()" wire:model="status" />
                    </div>
                </div>
            </x-card>
            <x-slot:actions>
                <x-button label="Cancel" link="/users" />
                <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </div>
</div>
