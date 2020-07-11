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
        <form action="{{ route('categories.update',[$id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-gro mb-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{$category->name}}"/>
            </div>
            <div class="form-group float-right">
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>



 
@endsection