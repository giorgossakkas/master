@extends('layouts.app')

@section('content')


<a href="/users/create" class="btn btn-primary float-right" />New user</a>

<h2>Users</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
        <tr>
          <th scope="row"><?php echo $key+1 ?></th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
              <a class="btn btn-primary" href="../users/{{ $user->id }}/edit">Update</a>
          </td>
          <td>
              <form action="/users/{{ $user->id }}" method="post">
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
