@extends('layouts.app')


@section('content')


<div class="card card-default">
    <div class="card-header bg-info text-white">
        Create posts
    </div>
    @if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show">
            {{$error}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>   
        </div>
    @endforeach
    @endif
        
    
    <div class="card-body">
        <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-gro mb-2">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="name"/>
            </div>
            <div class="form-gro mb-2">
                <label for="description">Description</label>
                <textarea rows="5" cols="5" class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-gro mb-2">
            <label for="content">Content</label>
                <input id="content" type="hidden" name="content" id="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-gro mb-2">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" id="published_at" name="published_at"/>
            </div>
            <div class="form-gro mb-2">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                 @foreach($categories as $category)   
                 <option value="{{$category->id}}">{{$category->name}}</option>
                 @endforeach
                </select>
            </div>
            <div class="form-gro mb-2">
                <label for="photo">Image</label>
                <input type="file" class="form-control" id="photo" name="photo"/>
            </div>

            <div class="form-group float-right">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>



 
@endsection