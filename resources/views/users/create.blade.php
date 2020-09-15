@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($user) ? 'Edit User' : 'Create User' }}
    </div>
    <div class="card-body">
        @include('partials.errors')
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="">
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
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                     Create User
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#preview").change(function(){
            readURL(this);
        });
    </script>
@endsection

@section('css')

@endsection
