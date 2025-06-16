<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:6',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'role_id'=> $request->role_id,
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {     
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'nullable|exists:roles,id',
        'password' => 'nullable|min:6',
    ]);

    // Siapkan data update
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $request->role_id,
    ];

    // Jika password diisi, hash dan masukkan ke data
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    // Superadmin boleh update status superadmin hanya untuk dirinya sendiri
    if (Auth::user()->isSuperAdmin() && Auth::id() === $user->id) {
    $data['is_superadmin'] = $request->has('is_superadmin');
}

    // Jalankan update
    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
