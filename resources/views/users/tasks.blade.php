@extends('layouts.app')

@section('content')
<h2>View Tasks assign to {{ $user->name }}</h2>
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
            @if ($task->status === 'COMPLETED')
               <span class="badge-pill badge-success">Completed</span>
            @else
               <span class="badge-pill badge-warning">Work in progress</span>
            @endif
          </td>
        </tr>
      @endforeach
  </tbody>
</table>

@endsection
