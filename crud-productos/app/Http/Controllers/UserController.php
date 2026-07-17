<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SanitizesData;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use SanitizesData;
    public function __construct()
    {
        $this->middleware(['auth', 'role:Administrador']);
    }

    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $this->sanitizeData($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ]));

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->sanitizeData($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ]));

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
