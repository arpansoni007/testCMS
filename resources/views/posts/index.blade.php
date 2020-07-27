@extends('layouts.app')


@section('content')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{session()->get('error')}}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Posts
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
        @if($posts->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Published At</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
         
                @foreach($posts as $post)
                <tr>
                    <td width="13%">{{$post->name}}</td>
                    <td width="30%"><img width="40%" height="30%" src="{{ Storage::url($post->image) }}"></img></td>
                    <td width="10%">@if($categories->count() > 0)<a href="{{ route('categories.edit',['category'=>$post->category->id])}}">{{$post->category->name}}</a>@endif</td>
                    <td width="22%">{{$post->published_at}}</td>
                    <td width="50%"> 
                    @if($post->trashed())
                    <form action="{{route('posts.restore',[$post->id])}}" method="POST"> 
                        @csrf 
                        @method('PUT')
                    <button type="submit"  class="btn btn-info">Restore</button>
                    </form> 
                    @else
                    <a href="{{route('posts.edit',[$post->id])}}" class="btn btn-info">Edit</a>
                    @endif
                    <form style="display:inline;"  action="{{route('posts.destroy',[$post->id])}}" method="POST">
                    @method('DELETE')
                    @csrf
                       
                        <button class="btn btn-danger" type="submit">{{$post->trashed() ? 'Delete' : 'Trash'}}</button>
                        </form>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <h5 class="text-center">No Posts Yet</h5>

        @endif
        <div class="float-right">
            {{$posts->links()}}
        </div>
    </div>
</div>




@endsection