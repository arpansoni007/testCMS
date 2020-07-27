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
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Categories
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
        @if($categories->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                
                @foreach($categories as $category)
                <tr>
                    <td width="75%">{{$category->name}}</td>
                    <td> <a href="{{route('categories.edit',[$category->id])}}" class="btn btn-info">Edit</a>
                        <a href="{{route('categories.destroy',[$category->id])}}" class="btn btn-danger" >Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <h5 class="text-center">No Categories Yet</h5>
        @endif
        <div class="float-right">
            {{$categories->links()}}
        </div>
    </div>
</div>




@endsection