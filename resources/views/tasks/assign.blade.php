@extends('layouts.app')

@section('content')


<form action="{{ route('task_assign',['id' => $task->id ]) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="assign_to_user_id">Assign task {{ $task->name }} to</label>
        <select class="form-control" id="assign_to_user_id" name="assign_to_user_id">
            <option value="">Select user</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ ( $user->id == old('assign_to_user_id')) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
      </div>

    <a href="{{ route('task_index') }}" class="float-right p-2" />Cancel</a>
    <button type="submit" class="btn btn-primary float-right" name="update" id="update">Update</button>
</form>
@endsection
