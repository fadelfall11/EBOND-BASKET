<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    public function index(): View
    {
        $users = User::orderByDesc('is_admin')->orderBy('name')->paginate(30);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'is_admin' => ['nullable', 'boolean'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $newIsAdmin = (bool) ($validated['is_admin'] ?? false);

        if ($request->user()?->id === $user->id && ! $newIsAdmin) {
            abort(403);
        }

        if ($user->is_admin && ! $newIsAdmin) {
            $adminCount = User::where('is_admin', true)->count();
            if ($adminCount <= 1) {
                abort(403);
            }
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->is_admin = $newIsAdmin;

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (request()->user()?->id === $user->id) {
            abort(403);
        }

        if ($user->is_admin) {
            $adminCount = User::where('is_admin', true)->count();
            if ($adminCount <= 1) {
                abort(403);
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
