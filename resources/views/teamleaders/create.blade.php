@extends('layouts.app')

@section('content')

<form action="{{ route('teamleader_store') }}" method="post">
  @csrf
  <div class="form-group">
		<label for="name">Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            placeholder="Provide name"
            value = {{ old('name') }} >
	</div>

  <div class="form-group">
		<label for="email">Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            id="email"
            placeholder="Provide email"
            value = {{ old('email') }} >
	</div>

  <div class="form-group">
		<label for="password">Password</label>
        <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Provide password"
            value = {{ old('password') }} >
	</div>

  <div class="form-group">
      <label for="role_id">Role</label>
      <select class="form-control" id="role_id" name="role_id">
          <option value="">Select role</option>
          @foreach ($roles as $role)
              <option value="{{ $role->id }}" {{ ( $role->id == old('role_id')) ? 'selected' : '' }}>
                  {{ $role->name }}
              </option>
          @endforeach
      </select>
  </div>


  <a href="{{ route('teamleader_index') }}" class="float-right p-2" />Cancel</a>
  <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

@endsection
