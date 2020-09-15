@extends('layouts.app')

@section('content')
    @if (auth()->user()->isAdmin())
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success float-right">Add Categories</a>
    </div>
    @endif
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
           @if ($categories->count() > 0)
           <?php $i = 1; ?>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td style="vertical-align: middle;">
                                {{ $i++ }}
                            </td>
                            <td style="vertical-align: middle;">
                                <a href="{{ route('categories.show', $category->id) }}">
                                    {{ $category->category_name }}
                                </a>
                            </td>
                            @if (auth()->user()->isAdmin())
                            <td style="vertical-align: middle;">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Delete</button>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deletecategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">
                                    Are you sure want to delete this category?
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
            <h4 class="text-center">No Categories Yet</h3>
           @endif
        </div>
    </div>
    <script>
        function handleDelete(id){
            var form = document.getElementById('deletecategoryForm')
            form.action = '/categories/' + id
            $('#deleteModal').modal("show")
        }
    </script>
@endsection

@section('scripts')

@endsection
