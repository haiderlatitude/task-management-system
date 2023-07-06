<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle text-dark nav-link-lg nav-link-user">
                {{auth()->user()->name}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Hello {{auth()->user()->name}}</div>
                <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </li>
    </ul>
</nav>
