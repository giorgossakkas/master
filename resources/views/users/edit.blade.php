@extends('layouts.app')

@section('content')


<form action="/users/{{ $user->id}}/update" method="post">
    @csrf
    <div class="form-group">
  		<label for="name">Name</label>
          <input
              type="text"
              name="name"
              class="form-control"
              id="name"
              placeholder="Provide name"
              value="{{ old('name',  $user->name) }}" >
  	</div>

    <div class="form-group">
  		<label for="email">Email</label>
          <input
              type="email"
              name="email"
              class="form-control"
              id="email"
              placeholder="Provide email"
              value = {{  old('email',  $user->email) }} >
  	</div>

    <div class="form-group">
        <label for="role_id">Role</label>
        <select class="form-control" id="role_id" name="role_id">
            <option>Select role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ ( $role->id == $user->role_id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="team_leader_id">Team Leader</label>
        <select class="form-control" id="team_leader_id" name="team_leader_id">
            <option>Select team leader</option>
            @foreach ($teamLeaders as $teamLeader)
                <option value="{{ $teamLeader->id }}" {{ ( $teamLeader->id == $user->team_leader_id) ? 'selected' : '' }}>
                    {{ $teamLeader->name }}
                </option>
            @endforeach
        </select>
    </div>


    <a href="/users/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>
@endsection
