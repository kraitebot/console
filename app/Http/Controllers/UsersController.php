<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class UsersController extends Controller
{
    private const SORTABLE_COLUMNS = ['name', 'email', 'status', 'is_admin', 'created_at'];

    private const PAGE_SIZE = 10;

    private const TABS = ['details', 'accounts', 'positions', 'billing'];

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $sort = in_array($request->query('sort'), self::SORTABLE_COLUMNS, true)
            ? $request->query('sort')
            : 'created_at';
        $direction = $request->query('dir') === 'asc' ? 'asc' : 'desc';

        $users = User::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($q) use ($search): void {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(self::PAGE_SIZE)
            ->withQueryString();

        return view('users.index', [
            'users' => $users,
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bin2hex(random_bytes(16));

        $user = User::create($data);

        return redirect()
            ->route('users.show', $user)
            ->with('flash', "User {$user->name} created.");
    }

    public function show(User $user, Request $request): View
    {
        $tab = in_array($request->query('tab'), self::TABS, true)
            ? $request->query('tab')
            : 'details';

        return view('users.show', [
            'user' => $user,
            'tab' => $tab,
            'tabs' => self::TABS,
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()
            ->route('users.show', $user)
            ->with('flash', "User {$user->name} updated.");
    }
}
