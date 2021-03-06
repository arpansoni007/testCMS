@extends('layouts.app')


@section('content')


<div class="card card-default">
    <div class="card-header bg-info text-white">
        Edit categories
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
        <form action="{{ route('update.posts',[$posts['id']])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-gro mb-2">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$posts->name}}"/>
            </div>
            <div class="form-gro mb-2">
                <label for="description">Description</label>
                <textarea rows="5" cols="5" class="form-control" id="description"  name="description">{{$posts->description}}</textarea>
            </div>
            <div class="form-gro mb-2">
            <label for="content">Content</label>
                <textarea rows="5" cols="5" class="form-control" id="content"  name="content">{{$posts->description}}</textarea>
            </div>
            <div class="form-gro mb-2">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" id="published_at" value="{{$posts->published_at}}"  name="published_at"/>
            </div>
            <div class="form-gro mb-2">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                 @foreach($categories as $category)   
                
                 <option value="{{$category->id}}" <?php if($category->id == $posts->category_id) { echo "selected";} ?> >{{$category->name}}</option>
                 @endforeach
                </select>   
            </div>
            <img src="{{Storage::url($posts->image)}}" />
            <div class="form-gro mb-2">
                <label for="photo">Photo</label>
                <input type="file" class="form-control"  name="photo" id="photo" value="{{$posts->image}}" />
            </div>

            <div class="form-group float-right">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>



 
@endsection