<?php

declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('New User - Kraite Console')]
final class UserCreate extends Component
{
    use WithFileUploads;

    public string $name = '';

    public string $email = '';

    public mixed $avatarImage = null;

    public bool $is_admin = false;

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'avatarImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'is_admin' => ['boolean'],
        ];
    }

    public function save(): mixed
    {
        $this->name = trim($this->name);
        $this->email = mb_strtolower(trim($this->email));

        $data = $this->validate();
        $data['avatar'] = $this->resolvedAvatarPath();
        unset($data['avatarImage']);

        $data['status'] = 'active';
        $data['password'] = bin2hex(random_bytes(16));

        $user = User::create($data);

        session()->flash('flash', "User {$user->name} created.");

        return $this->redirectRoute('users.show', ['user' => $user], navigate: true);
    }

    public function render(): View
    {
        return view('livewire.users.create');
    }

    private function resolvedAvatarPath(): ?string
    {
        if ($this->avatarImage) {
            $path = $this->avatarImage->store('avatars/users', 'public');

            return Storage::disk('public')->url($path);
        }

        return null;
    }
}
