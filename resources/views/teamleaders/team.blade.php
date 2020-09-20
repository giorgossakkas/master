@extends('layouts.app')

@section('content')

<h2>Team of {{ $user->name }}</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
        <tr>
          <th scope="row"><?php echo $key+1 ?></th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
        </tr>
      @endforeach
  </tbody>
</table>

@endsection
