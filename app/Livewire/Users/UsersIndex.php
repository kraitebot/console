<?php

declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Users - Kraite Console')]
final class UsersIndex extends Component
{
    use WithPagination;

    private const PAGE_SIZE = 10;

    private const COLUMNS = [
        ['key' => 'name', 'label' => 'Name', 'sortable' => true, 'searchable' => true],
        ['key' => 'email', 'label' => 'Email', 'sortable' => true, 'searchable' => true],
        ['key' => 'is_admin', 'label' => 'Role', 'sortable' => true, 'searchable' => true],
        ['key' => 'status', 'label' => 'Status', 'sortable' => true, 'searchable' => true],
        ['key' => 'created_at', 'label' => 'Joined', 'sortable' => true, 'searchable' => true],
    ];

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(as: 'sort', except: 'created_at')]
    public string $sort = 'created_at';

    #[Url(as: 'dir', except: 'desc')]
    public string $direction = 'desc';

    public ?string $flashToastMessage = null;

    public function mount(): void
    {
        if (session()->has('flash')) {
            $this->flashToastMessage = session('flash');
        }
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function searchFor(string $search): void
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function sortBy(string $column): void
    {
        if (! in_array($column, $this->sortableColumns(), true)) {
            return;
        }

        if ($this->sort === $column) {
            $this->direction = $this->direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $column;
            $this->direction = 'asc';
        }

        $this->resetPage();
    }

    public function render(): View
    {
        $users = User::query()
            ->when(trim($this->search) !== '', function (Builder $query): void {
                $search = trim($this->search);
                $normalizedSearch = mb_strtolower($search);

                $query->where(function (Builder $q) use ($search, $normalizedSearch): void {
                    foreach ($this->searchableColumns() as $column) {
                        match ($column) {
                            'is_admin' => $this->applyRoleSearch($q, $normalizedSearch),
                            default => $q->orWhere($column, 'like', "%{$search}%"),
                        };
                    }
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(self::PAGE_SIZE);

        return view('livewire.users.index', [
            'users' => $users,
            'columns' => self::COLUMNS,
        ]);
    }

    /**
     * @return array<int, string>
     */
    private function sortableColumns(): array
    {
        return array_column(array_filter(self::COLUMNS, fn (array $column): bool => $column['sortable']), 'key');
    }

    /**
     * @return array<int, string>
     */
    private function searchableColumns(): array
    {
        return array_column(array_filter(self::COLUMNS, fn (array $column): bool => $column['searchable']), 'key');
    }

    private function applyRoleSearch(Builder $query, string $search): void
    {
        if (str_contains('admin', $search)) {
            $query->orWhere('is_admin', true);
        }

        if (str_contains('user', $search)) {
            $query->orWhere('is_admin', false);
        }
    }
}
