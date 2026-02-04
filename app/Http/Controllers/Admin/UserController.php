<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = [
            UserRole::ADMIN->value,
            UserRole::CREATOR->value,
            UserRole::EMPLOYER->value,
            UserRole::MEMBER->value,
        ];

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,creator,employer,buyer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = UserRole::from($request->role);

        // Only Employer & Creator need approval
        $isApproved = !in_array($role, [UserRole::EMPLOYER, UserRole::CREATOR]);
        $isActive   = $isApproved;

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'role'        => $role->value,
            'password'    => Hash::make($request->password),
            'is_active'   => $isActive,
            'is_approved' => $isApproved,
            'settings'    => [],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = [
            UserRole::ADMIN->value,
            UserRole::CREATOR->value,
            UserRole::EMPLOYER->value,
            UserRole::MEMBER->value,
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Cannot modify Super Admin.');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,creator,employer,buyer',
        ]);

        $role = UserRole::from($request->role);

        // Only Employer & Creator need approval
        $isApproved = !in_array($role, [UserRole::EMPLOYER, UserRole::CREATOR]);
        $isActive   = $isApproved;

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'role'        => $role->value,
            'is_active'   => $isActive,
            'is_approved' => $isApproved,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Cannot delete Super Admin.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    // APPROVE USER
    public function approve(User $user)
    {
        $role = strtolower($user->role instanceof UserRole ? $user->role->value : $user->role);

        if (!in_array($role, ['employer', 'creator'])) {
            return back()->with('error', 'This user does not require approval.');
        }

        if ($user->is_approved) {
            return back()->with('info', 'User is already approved.');
        }

        $user->update([
            'is_approved' => true,
            'is_active'   => true,
        ]);

        return back()->with('success', 'User approved successfully.');
    }

    // DISAPPROVE USER
    public function disapprove(User $user)
    {
        $role = strtolower($user->role instanceof UserRole ? $user->role->value : $user->role);

        if (!in_array($role, ['employer', 'creator'])) {
            return back()->with('error', 'This user cannot be disapproved.');
        }

        if (!$user->is_approved) {
            return back()->with('info', 'User is already disapproved.');
        }

        $user->update([
            'is_approved' => false,
            'is_active'   => false,
        ]);

        return back()->with('success', 'User disapproved successfully.');
    }
}
