@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($book) ? 'Edit Book' : 'Create Book' }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ( isset($book) )
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ isset($book) ? $book->name : '' }}">
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if (isset($book))
                                    @if ($category->id == $book->category_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" id="description" class="form-control" name="description">{{ isset($book) ? $book->description : '' }}</textarea>
                </div>
                @if (isset($book))
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $book->image) }}" class="img-thumbnail" width="100" height="50">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="preview">Preview</label>
                    <img src="#" id="preview" width="200px" />   <!--for preview purpose -->
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($book) ? 'Update book' : 'Add book' }}
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
