@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">Books of <b>{{ $category->category_name }}</b> Category</div>
        <div class="card-body">
            @if ($books->count() > 0)
            <table class="table">
                <thead>
                    <th>Nama</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td style="vertical-align: middle;">
                                {{ $book->name }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $book->description }}
                            </td>
                            <td style="vertical-align: middle;">
                                <img src="{{ asset('storage/' . $book->image) }}" class="img-thumbnail" width="100" height="50">
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
