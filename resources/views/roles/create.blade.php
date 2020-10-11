@extends('layouts.app')

@section('content')

<form action="{{ route('role_store') }}" method="post">
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
  @foreach ($permissions as $permission)

  <div class="form-group">
    <label class="checkbox-inline">
        <input type="checkbox"
           data-toggle="toggle"
           id={{ $permission }}
           name={{ $permission }}
           value=true>{{ $permission }}
    </label>
  </div>
@endforeach


  <a href="{{ route('role_index') }}" class="float-right p-2" />Cancel</a>
  <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

@endsection
