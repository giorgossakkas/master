@extends('layouts.app')

@section('content')


<a href="/tasks/create" class="btn btn-primary float-right" />New task</a>

<h2>Tasks</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Signed</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
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
          <td>
              @if ($task->assign_to_user_id === null)
                 <span class="badge-pill badge-danger">Un-Assigned</span>
                 <a class="btn btn-primary" href="/tasks/{{$task->id}}/assign">Assign</a>
              @else
                 <form action="/tasks/{{ $task->id }}/unassign" method="post">
                     @csrf
                     <span class="badge-pill badge-warning">Assigned</span>
                     <button class="btn btn-primary" type="submit">Unassign</button>
                 </form>
              @endif
          </td>
          <td>
              <a class="btn btn-primary" href="../tasks/{{ $task->id }}/edit">Update</a>
          </td>
          <td>
              <form action="/tasks/{{ $task->id }}" method="post">
                  @csrf
                  {{ method_field('delete') }}
                  <button class="btn btn-danger" type="submit">Delete</button>
              </form>
          </td>
        </tr>
      @endforeach
  </tbody>
</table>

@endsection
