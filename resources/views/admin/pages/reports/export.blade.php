<div style="text-align: center; font-size: 30px; font-weight: 900; margin-bottom: 90px;" id="taskReport">
  Task Report ({{$timePeriod}})
</div>
<div>
  Dated: {{date('Y-m-d h:i:s', strtotime(now()))}}
</div>
<table style="border: 1px solid black; width: 100%;" class="table" id="table">
  <thead>
    <tr>
      <th style="text-align: left; line-height: 25px;">Name</th>
      <th style="text-align: left; line-height: 25px;">Description</th>
      <th style="text-align: left; line-height: 25px;">Status</th>
      <th style="text-align: left; line-height: 25px;">Due Date</th>
      <th style="text-align: left; line-height: 25px;">Complete Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tasks as $task)
    <tr>
        <td style="text-align: start; line-height: 25px;">{{ $task->name}}</td>
        <td style="text-align: start; line-height: 25px;">
          {{$task->description}}
        </td>
        <td style="text-align: start; line-height: 25px;">
            @if ($task->status_id == 1)
                Pending
            @elseif ($task->status_id == 2)
                In Progress
            @else
                Completed
            @endif
        </td>
        <td style="text-align: start; line-height: 25px;">
          {{date('d m Y', strtotime($task->due_date))}}
        </td>
        <td style="text-align: start; line-height: 25px;">
            {{date('d m Y', strtotime($task->completed_at))}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>