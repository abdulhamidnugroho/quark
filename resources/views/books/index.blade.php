@extends('layouts.app')

@section('content')
    @if (auth()->user()->isAdmin())
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('books.create') }}" class="btn btn-success">Add book</a>
    </div>
    @endif
    <div class="card card-default">
        <div class="card-header">Book</div>
        <div class="card-body">
            @if ($books->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Nama</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td style="vertical-align: middle;">
                                <img src="{{ asset('storage/' . $book->image) }}" class="img-thumbnail" width="100" height="50">
                            </td>
                            <td>
                                {{ $book->name }}
                            </td>
                            <td>
                                <a href="{{ route('categories.show', $book->category_id) }}">
                                    {{ $book->category->category_name }}
                                </a>
                            </td>
                            <td>
                                {{ $book->description }}
                            </td>
                            @if (auth()->user()->isAdmin())
                            <td>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('books.destroy', $book->id) }}" method="book">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
            @else
            <h4 class="text-center">No Books Yet</h4>
            @endif
        </div>
    </div>
@endsection
