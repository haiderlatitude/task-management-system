<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="mt-2"><b>All Task Details</b></h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Created By</th>
                  <th>Completed At</th>
                  <th>Assigned To</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->name}}</td>
                    <td>
                      {{$task->description}}
                    </td>
                    <td @if($task->status->name == 'pending') class="text-danger" @elseif ($task->status->name == 'in-progress') class="text-warning" @else class="text-success" @endif>
                        {{ ucfirst($task->status->name) }}
                    </td>
                    <td>
                        @if ($task->creator == null)
                        None
                        @else
                            {{ ucfirst($task->creator->name) }}
                        @endif
                    </td>
                    <td>
                      @if ($task->completed_at == null)
                        Pending
                      @else
                          {{ date('d m Y | g:i A', strtotime($task->completed_at)) }}
                      @endif
                  </td>
                    <td>
                        @if ($task->users->first() == null)
                        None
                        @else
                            @foreach ($task->users as $user)
                                {{ ucfirst($user->name) }}
                                @if (!$user == $loop->last)
                                    ,
                                @endif
                            @endforeach
                        @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>