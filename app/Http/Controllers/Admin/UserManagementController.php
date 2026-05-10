<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use Illuminate\View\View;

use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        $users = User::query()
                ->with('roles')
                ->latest()
                ->paginate(10);

        return view(
            'admin.users.index',
            compact('users')
        );
    }
}