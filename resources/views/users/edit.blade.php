@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My Profile</div>

    <div class="card-body">
        @include('partials.errors')
        <form action="{{ route('users.update-profile') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        @foreach ($users as $role)
                            <option value="{{$role}}"
                                @if (isset($user))
                                    @if ($user->role == $role)
                                        selected
                                    @endif
                                @endif
                                >
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
            </div>
            <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>
@endsection
