<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard">
                <span class="logo-name">TMS</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li>
                <a href="/dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
        </ul>
        @if(auth()->user()->hasRole('admin'))
        <ul class="sidebar-menu">
            <li>
                <a class="menu-toggle nav-link has-dropdown cursor-pointer"><i data-feather="users"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/admin/all-users">All Users</a></li>
                    <li><a class="nav-link" href="/admin/add-user">Add User</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li>
                <a class="menu-toggle nav-link has-dropdown cursor-pointer"><i data-feather="list"></i><span>Tasks</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/admin/add-task">Add Task</a></li>
                    <li><a class="nav-link" href="/admin/all-tasks">All Tasks</a></li>
                    <li><a class="nav-link" href="/admin/task-form">Assign Task</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Roles and Permissions</li>
            <li>
                <a class="menu-toggle nav-link has-dropdown cursor-pointer"><i data-feather="shield"></i><span>Roles & Permissions</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/admin/all-roles">All Roles</a></li>
                    <li><a class="nav-link" href="/admin/add-role">Add Role</a></li>
                    <li><a class="nav-link" href="/admin/assign-role">Assign Role</a></li>
                    <li><a class="nav-link" href="/admin/all-permissions">All Permissions</a></li>
                    <li><a class="nav-link" href="/admin/add-permission">Add Permission</a></li>
                    <li><a class="nav-link" href="/admin/assign-permission">Assign Permission to a Role</a></li>
                </ul>
            </li>
        </ul>
        @else
        <ul class="sidebar-menu">
            <li>
                <a class="menu-toggle nav-link has-dropdown cursor-pointer"><i data-feather="list"></i><span>Tasks</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/users/{{auth()->user()->name}}/my-tasks">My Tasks</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Roles and Permissions</li>
            <li>
                <a class="menu-toggle nav-link has-dropdown cursor-pointer"><i data-feather="shield"></i><span>Roles & Permissions</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/users/{{auth()->user()->name}}/my-roles">My Roles</a></li>
                    <li><a class="nav-link" href="/users/{{auth()->user()->name}}/my-permissions">My Permissions</a></li>
                </ul>
            </li>
        </ul>
        @endif
        <ul class="sidebar-menu">
            <li class="menu-header">Settings</li>
            <li>
                <a href="/edit-profile" class="nav-link"><i data-feather="settings"></i><span>Profile</span></a>
            </li>
        </ul>
    </aside>
</div>