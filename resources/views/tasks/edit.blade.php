@extends('layouts.app')

@section('content')


<form action="{{ route('task_update',['id' => $task->id ]) }}" method="post">
    @csrf
    <div class="form-group">
  		<label for="name">Name</label>
          <input
              type="text"
              name="name"
              class="form-control"
              id="name"
              placeholder="Provide name"
              value="{{ old('name',  $task->name) }}" >
  	</div>

    <div class="form-group">
  		<label for="description">Description</label>
        <textarea
            class="form-control"
            name="description"
            placeholder="Description">{{  old('description',  $task->description) }}</textarea>
  	</div>

    <a href="{{ route('task_index') }}" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>
@endsection
