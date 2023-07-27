<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionAssignRequest;
use App\Http\Requests\RoleAssignRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\User;
use App\Notifications\RoleAssigned;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
    public function store(RoleStoreRequest $request) {
        try{
            $errors = [];
            
            $roles = explode(',', $request->name);
            foreach($roles as $key => $value){
                try{
                    if($value != '')
                        Role::create(['name' => trim(preg_replace('/[^A-Za-z ]/', '', $value))]);
                }
                catch(\Exception $e){
                    $errors[$key] = str_replace(" for guard `web`.", '', $e->getMessage());
                    $errors[$key++];
                }
            }

            if($errors != '')
                return back()->withErrors($errors);

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
    public function storeEditedRole(RoleUpdateRequest $request, $roleId) {
        try {
            $request->validate([
                'name' => 'unique:roles,name,'.$roleId,
            ]);
            $role = Role::findById($roleId);

            if($role->name != 'admin')
                $role->name = $request->name;

            $role->syncPermissions($request->permissions);
            $role->save();

            return redirect('/admin/all-roles')->with('message', 'Role details have been updated successfully!');
        } catch(ValidationException $e) {
            return back()->withErrors('Role name already exists!');
        } catch(\Exception $e) {
            return back()->withErrors('Oops! Something went wrong!');
        }
    }

    // View for assigning role to a user
    public function assignRole() {
        $roles = Role::all();
        $users = User::all();
        return view('admin.pages.roles.assign', compact('roles', 'users'));
    }

    // Assign role to a user
    public function assignRoleToUser(RoleAssignRequest $request) {
        try {
            $user = User::find($request->user);
            foreach($request->roles as $roleId){
                $role = Role::findById($roleId);
                $user->assignRole($role);
            }
            $user->notify(new RoleAssigned());
            return redirect('/admin/all-roles')->with('message', 'Role(s) have been assigned successfully!');
        } catch(\Exception $e){
            return back()->withErrors('Something went wrong!');
        }
    }

    // Listing all permissions
    public function allPermissions() {
        $permissions = Permission::all();
        return view('admin.pages.roles.permissions', compact('permissions'));
    }

    // View for assigning permission
    public function assignPermission() {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.pages.roles.assignPermission', compact('permissions', 'roles'));
    }

    // Assign permission to a role
    public function assignPermissionToRole(PermissionAssignRequest $request) {
        $role = Role::findById($request->role);
        foreach($request->permissions as $permissionId){
            $permission = Permission::findById($permissionId);
            $role->givePermissionTo($permission);
        }

        return redirect('/admin/all-roles')->with('message', '"'.ucfirst($role->name).'" role has been given all selected permissions.');
    }
}