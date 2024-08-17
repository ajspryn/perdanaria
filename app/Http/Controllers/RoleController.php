<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('content.role.index', [
      'roles' => Role::all(),
      'permissions' => Permission::all(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // Validasi input
    $validated = $request->validate([
      'role_name' => 'required|string|max:255',
      'permission' => 'required|array',
      'permission.*' => 'exists:permissions,id' // Validasi ID permission
    ]);

    // Cek apakah role sudah ada berdasarkan nama dan guard 'web'
    $role = Role::firstOrCreate(
      ['name' => $validated['role_name'], 'guard_name' => 'web']
    );

    // Menambahkan permissions ke role
    if (isset($validated['permission'])) {
      $permissions = Permission::whereIn('id', $validated['permission'])
        ->where('guard_name', 'web')
        ->get();

      foreach ($permissions as $permission) {
        if (!$role->hasPermissionTo($permission)) {
          $role->givePermissionTo($permission);
        }
      }
    }

    // Redirect atau response yang sesuai
    return redirect()->route('roles.index')->with('success', 'Role and Permissions created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Role $role)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Role $role)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role)
  {
    //
  }
}
