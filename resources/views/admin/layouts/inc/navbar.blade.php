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
        <button id="notification-bell" class="fa fa-bell mr-3">
            @if (auth()->user()->unreadNotifications->count() > 0)
                <sup class="bi bi-circle-fill text-blue-500"></sup>
            @endif
        </button>
    </div>
    <div id="notification-div" class="hidden dropdown-menu dropdown-menu-right bg-white w-2/6">
        <div class="flex justify-between flex-wrap">
            <div class="dropdown-header inline">Notifications</div>
            <div class="float-right dropdown-header text-dark">
                <form action="/read-all-notifications" method="POST">
                    @csrf
                    <input type="hidden" name="userId" id="userId" value="{{auth()->user()->id}}">
                    <button class="text-sm hover:text-blue-500 hover:underline">Mark All As Read</button>
                </form>
            </div>
        </div>
        <hr class="text-dark">
        @foreach (auth()->user()->notifications as $notification)
            @if($notification->read_at == NULL)
                <div>
                    <form action="/read-notification" method="POST" class="dropdown-item text-dark mx-2 my-2">
                        @csrf
                        <input type="hidden" name="notificationId" id="notificationId" value="{{$notification->id}}">
                        <input type="hidden" name="userId" id="userId" value="{{auth()->user()->id}}">
                        <button class="dropdown-item-desc bi bi-dot text-sm">{{$notification->data['data']}}</button>
                    </form>
                </div>
            @else
                <div>
                    <a href="/users/{{auth()->user()->name}}/my-tasks" class="dropdown-item text-dark mx-2 my-2">
                        <span class="dropdown-item-desc">{{$notification->data['data']}}</span>
                    </a>
                </div>
            @endif
        @endforeach
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
<script>
    $(document).ready(function(){
        const notificationBell = $('#notification-bell');
        const notificationDiv = $('#notification-div');
        notificationBell.click(function(){
            if(notificationDiv.hasClass('hidden')){
                notificationDiv.removeClass('hidden').addClass('show');
            }
            else
                notificationDiv.removeClass('show').addClass('hidden');
        });
});
</script>