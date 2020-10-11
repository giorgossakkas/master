@extends('layouts.app')

@section('content')


<a href="{{ route('role_create') }}" class="btn btn-primary float-right" />New role</a>

<h2>Roles</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($roles as $key=>$role)
        <tr>
          <th scope="row"><?php echo $key+1 ?></th>
          <td>{{ $role->name }}</td>
          <td>
              <a class="btn btn-primary" href="{{ route('role_edit',['id' => $role->id ]) }}">Update</a>
          </td>
          <td>
              <form action="{{ route('role_delete',['id' => $role->id ]) }}" method="post">
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
