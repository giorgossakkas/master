@extends('layouts.app')

@section('content')


<form action="/tasks/{{ $task->id}}/assign" method="post">
    @csrf
    <div class="form-group">
        <label for="assign_to_user_id">Assign task {{ $task->name }} to</label>
        <select class="form-control" id="assign_to_user_id" name="assign_to_user_id">
            <option>Select user</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ ( $user->id == old('assign_to_user_id')) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
      </div>

    <a href="/tasks/index" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>
@endsection
