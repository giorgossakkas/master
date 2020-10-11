@extends('layouts.app')

@section('content')

@if (count($teamMembers) > 0)
<h2>My Team</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Tasks</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($teamMembers as $key=>$user)
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
          <a class="btn btn-primary"  href="{{ route('user_show_user_tasks',['id' => $user->id ]) }}">View</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif


<h2>My Tasks</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tasks as $key=>$task)
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td>{{ $task->name }}</td>
      <td>{{ $task->description }}</td>
      <td>
        @if ($task->isCompleted())
           <span class="badge-pill badge-success">Completed</span>
        @else
            <form action="{{ route('task_complete',['id' => $task->id ]) }}" method="post">
                @csrf
                <span class="badge-pill badge-warning">Work in progress</span>
                <button class="btn btn-primary" type="submit">Complete</button>
            </form>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


@endsection
