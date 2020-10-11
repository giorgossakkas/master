@extends('layouts.app')

@section('content')

<form action="{{ route('task_store') }}" method="post">
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
		<label for="descr">Description</label>
    <textarea
        class="form-control"
        name="description"
        placeholder="Description" >{{ old('description') }}</textarea>
	</div>

  <a href="{{ route('task_index') }}" class="float-right p-2" />Cancel</a>
  <button type="submit" class="btn btn-primary float-right" name="create" id="create">Create</button>
</form>

@endsection
