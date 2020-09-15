@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($category) ? 'Edit Category' : 'Create Category' }}
    </div>
    <div class="card-body">
        @include('partials.errors')
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="category_name">Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" value="{{ isset($category) ? $category->category_name : '' }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ isset($category) ? 'Update category' : 'Create category' }}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@section('css')

@endsection
