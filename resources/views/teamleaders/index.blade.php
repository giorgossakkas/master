@extends('layouts.app')

@section('content')


<a href="{{ route('teamleader_create') }}" class="btn btn-primary float-right" />New team leader</a>

<h2>Team Leaders</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      <th scope="col">Team</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
        <tr>
          <th scope="row"><?php echo $key+1 ?></th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
              <a class="btn btn-primary" href="{{ route('teamleader_edit',['id' => $user->id ]) }}">Update</a>
          </td>
          <td>
              <form action="{{ route('teamleader_delete',['id' => $user->id ]) }}" method="post">
                  @csrf
                  {{ method_field('delete') }}
                  <button class="btn btn-danger" type="submit">Delete</button>
              </form>
          </td>
          <td>
              <a class="btn btn-primary" href="{{ route('teamleader_view_team',['id' => $user->id ]) }}">View</a>
          </td>
        </tr>
      @endforeach
  </tbody>
</table>

@endsection
