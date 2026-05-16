<?php

declare(strict_types=1);

namespace App\Livewire\Accounts;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Accounts - Kraite Console')]
final class AccountsIndex extends Component
{
    public function render(): View
    {
        return view('livewire.accounts.index');
    }
}
