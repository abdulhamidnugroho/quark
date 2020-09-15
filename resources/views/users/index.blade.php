@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('users.create') }}" class="btn btn-success float-right">Add users</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
           @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td style="vertical-align: middle;">
                                {{ $user->name }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $user->email }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $user->role }}
                            </td>
                            <td style="vertical-align: middle;">
                                @if (!$user->isAdmin())
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Make Admin</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteuserForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">
                                    Are you sure want to delete this user?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <h4 class="text-center">No users Yet</h3>
           @endif
        </div>
    </div>
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteuserForm')
            form.action = '/users/' + id
            $('#deleteModal').modal("show")
        }
    </script>
@endsection
