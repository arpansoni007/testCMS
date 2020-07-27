@extends('layouts.app')


@section('content')


<div class="card card-default">
    <div class="card-header bg-info text-white">
        Create categories
    </div>
    @if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show">
            {{$error}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>   
        </div>
    @endforeach
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
            {{session('error')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>   
    </div>
    @endif
    
    <div class="card-body">
        <form action="{{ route('categories.store')}}" method="POST">
            @csrf
            <div class="form-gro mb-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name"/>
            </div>
            <div class="form-group float-right">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>



 
@endsection