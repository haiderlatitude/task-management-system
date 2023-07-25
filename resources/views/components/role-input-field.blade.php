<div class="card-body">
    <div class="form-group">
        <label>Role</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="bi bi-shield"></i>
                </div>
            </div>
            <select class="text-dark" name="roleId" id="roleId">
                <option value="" selected>-- Role --</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
            <p class="mx-3 text-xs">*Default Role: User</p>
        </div>
    </div>
</div>