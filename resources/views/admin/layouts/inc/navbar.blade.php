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
    <div>
        <i class="fa fa-bell mr-3 has-dropdown"></i>
    </div>
    <div class="dropdown-menu dropdown-menu-right bg-white w-80 show">
        <div class="dropdown-header inline">Notifications</div>
        <div class="float-right mx-3 text-dark">
            <a href="#">Mark All As Read</a>
        </div>
        <hr class="text-dark">
        <div>
            <a href="#" class="dropdown-item dropdown-item-unread text-dark mx-2 my-2">
                <span class="dropdown-item-desc">Hello</span>
            </a>
            <a href="#" class="dropdown-item text-dark mx-2 my-2">
                <span class="dropdown-item-desc">Hello</span>
            </a>
        </div>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a data-toggle="dropdown" class="nav-link cursor-pointer dropdown-toggle text-dark nav-link-lg nav-link-user">
                {{ucfirst(auth()->user()->name)}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Hello {{auth()->user()->name}}</div>
                <div class="mt-3 space-y-1">    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
