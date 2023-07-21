<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\RoleAssigned;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleNPermissionController extends Controller
{
    // Listing all roles
    public function allRoles() {
        $roles = Role::all();
        return view('admin.pages.roles.index', compact('roles'));
    }

    // View for adding role
    public function addRole() {
        return view('admin.pages.roles.add');
    }

    // Store new role details
    public function store(Request $request) {
        try{
            $errors = '';
            if($request->name == '')
                return back()->withErrors('Role name cannot be empty!');
            
            $roles = explode(',', $request->name);
            foreach($roles as $role){
                try{
                    if($role != '')
                        Role::create(['name' => trim(preg_replace('/[^A-Za-z ]/', '', $role))]);
                }
                catch(\Exception $e){
                    $errors .= $e->getMessage().' ';
                }
            }

            if($errors != '')
                return redirect('/admin/all-roles')->withErrors($errors);

            return redirect('/admin/all-roles')->with('message', 'All role(s) have been added successfully!');
        }
        catch(\Exception $e){
            return back()->withErrors('Some error occured please try again later!');
        }
    }

    // View for editing role details
    public function editRole($roleId) {
        $role = Role::findById($roleId);
        return view('admin.pages.roles.edit', compact('role'));
    }

    // Store edited role details
    public function storeEditedRole(Request $request, $roleId) {
        $role = Role::findById($roleId);
        if($role->name != 'admin')
            $role->name = $request->name;
        if($request->name == '')
            return redirect('/admin/all-roles')->withErrors('Role name cannot be empty!');

        $role->syncPermissions($request->permissions);
        $role->save();

        return redirect('/admin/all-roles')->with('message', 'Role details have been updated successfully!');
    }

    // View for assigning role to a user
    public function assignRole() {
        $roles = Role::all();
        $users = User::all();
        return view('admin.pages.roles.assign', compact('roles', 'users'));
    }

    // Assign role to a user
    public function assignRoleToUser(Request $request) {
        try{
            if($request->roles == '' || $request->user == 'select-user')
                return back()->withErrors('Please select at least one Role and a User!');
            $user = User::find($request->user);
            foreach($request->roles as $roleId){
                $role = Role::findById($roleId);
                $user->assignRole($role);
            }
            $user->notify(new RoleAssigned());
            return redirect('/admin/all-roles')->with('message', 'Role(s) have been assigned successfully!');
        } catch(\Exception $e){
            return redirect('/admin/assign-role')->withErrors('Something went wrong!');
        }
    }

    // Listing all permissions
    public function allPermissions() {
        $permissions = Permission::all();
        return view('admin.pages.roles.permissions', compact('permissions'));
    }

    // View for adding a permission
    public function addPermission() {
        return view('admin.pages.roles.addPermission');
    }

    // Store a single or multiple permissions' details
    public function storePermission(Request $request) {
        try{
            $errors = '';
            if($request->name == '')
                return back()->withErrors('Permission name cannot be empty!');
            
            $permissionNames = explode(',', $request->name);
            foreach($permissionNames as $permissionName){
                try{
                    if($permissionName != '')
                        Permission::create(['name' => Str::slug($permissionName)]);
                }
                catch(\Exception $e){
                    $errors .= $e->getMessage().' ';
                }
            }
            if($errors != '')
                return redirect('/admin/all-permissions')->withErrors($errors);

            return redirect('/admin/all-permissions')->with('message', 'Permission(s) have been added successfully!');

        } catch(\Exception $e){
            return back()->withErrors('Some permission(s) already exist!');
        }
    }

    // View for assigning permission
    public function assignPermission() {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.pages.roles.assignPermission', compact('permissions', 'roles'));
    }

    // Assign permission to a role
    public function assignPermissionToRole(Request $request) {
        if($request->permissions == '' || $request->role == 'select-role')
            return back()->withErrors('Please select at least one permission and a Role!');
        $role = Role::findById($request->role);
        foreach($request->permissions as $permissionId){
            $permission = Permission::findById($permissionId);
            $role->givePermissionTo($permission);
        }

        return redirect('/admin/all-roles')->with('message', '"'.ucfirst($role->name).'" role has been given all selected permissions.');
    }
}