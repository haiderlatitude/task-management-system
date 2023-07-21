<div id="notification-div" class="hidden dropdown-menu dropdown-menu-right bg-white w-3/6">
    <div class="flex justify-between flex-wrap">
        <div class="dropdown-header inline">Notifications</div>
        <div class="float-right dropdown-header text-dark">
            <form action="/read-all-notifications" method="POST">
                @csrf
                <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                <button class="text-sm hover:text-blue-500 hover:underline">Mark All As Read</button>
            </form>
        </div>
    </div>
    <hr class="text-dark">
    @foreach (auth()->user()->notifications as $notification)
        @if ($notification->read_at == null)
            <div class="my-1">
                <form action="/read-notification" method="POST" class="dropdown-item text-dark inline">
                    @csrf
                    <input type="hidden" name="notificationId" id="notificationId" value="{{ $notification->id }}">
                    <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                    <button class="dropdown-item-desc text-sm">{{ $notification->data['data'] }}</button>
                    <span class="bi bi-dot float-left"></span>
                </form>
                <form action="/delete-notification" method="POST" class="inline">
                    @csrf @method('delete')
                    <input type="hidden" name="notificationId" id="notificationId" value="{{ $notification->id }}">
                    <button class="bi bi-trash text-danger float-right mr-2"></button>
                </form>
            </div>
        @else
            <div class="my-1">
                <form action="/read-notification" method="POST" class="dropdown-item text-dark inline">
                    @csrf
                    <input type="hidden" name="notificationId" id="notificationId" value="{{ $notification->id }}">
                    <input type="hidden" name="userId" id="userId" value="{{ auth()->user()->id }}">
                    <button class="dropdown-item-desc text-sm">{{ $notification->data['data'] }}</button>
                    <span class="bi bi-dot invisible float-left"></span>
                </form>
                <form action="/delete-notification" method="POST" class="inline">
                    @csrf @method('delete')
                    <input type="hidden" name="notificationId" id="notificationId" value="{{ $notification->id }}">
                    <button class="bi bi-trash text-danger float-right mr-2"></button>
                </form>
            </div>
        @endif
    @endforeach
</div>

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