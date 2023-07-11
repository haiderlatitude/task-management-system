<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleNPermissionController extends Controller
{
    public function allRoles() {
        $roles = Role::all();
        return view('admin.pages.roles.index', compact('roles'));
    }

    public function addRole() {
        return view('admin.pages.roles.add');
    }

    public function store(Request $request) {
        try{
            $role = Role::findByName($request->name);
            return back()->withErrors('The role of "'.ucfirst($role->name).'" already exists!');
        }
        catch(\Exception $e){
            Role::create(['name' => $request->name]);
            return redirect('/admin/all-roles')->with('message', 'Role has been created successfully!');
        }
    }

    public function editRole($roleId) {
        $role = Role::findById($roleId);
        return view('admin.pages.roles.edit', compact('role'));
    }

    public function storeEditedRole(Request $request, $roleId) {
        $role = Role::findById($roleId);
        if($role->name == 'admin')
            $role->name = 'admin';
        else
            $role->name = $request->name;
        $role->syncPermissions($request->permissions);
        if(!$request->users == null){
            foreach($request->users as $userId){
                $user = User::find($userId);
                $user->removeRole($role);
            }
        }
        $role->save();

        return redirect('/admin/all-roles')->with('message', 'Role details have been updated successfully!');
    }

    public function assignRole() {
        $roles = Role::all();
        $users = User::all();
        return view('admin.pages.roles.assign', compact('roles', 'users'));
    }

    public function assignRoleToUser(Request $request) {
        try{
            $role = Role::find($request->role);
            $user = User::find($request->user);
            $user->assignRole($role);
            return redirect('/admin/all-roles')->with('message', 'Role has been assigned successfully!');
        } catch(\Exception $e){
            return redirect('/admin/assign-role')->withErrors('Something went wrong!');
        }
    }

    public function allPermissions() {
        $permissions = Permission::all();
        return view('admin.pages.roles.permissions', compact('permissions'));
    }

    public function addPermission() {
        return view('admin.pages.roles.addPermission');
    }

    public function storePermission(Request $request) {
        try{
            Permission::create(['name' => Str::slug($request->name)]);
            return redirect('/admin/all-permissions')->with('message', 'Permission has been added successfully!');

        } catch(\Exception $e){
            return back()->withErrors('This permission already exists!');
        }
    }

    public function assignPermission() {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.pages.roles.assignPermission', compact('permissions', 'roles'));
    }

    public function assignPermissionToRole(Request $request) {
        $role = Role::findById($request->role);
        $permission = Permission::findById($request->permission);
        $role->givePermissionTo($permission);

        return redirect('/admin/all-roles')->with('message', '"'.ucfirst($role->name).'" role has been given the permission to "'.$permission->name.'"');
    }
}
