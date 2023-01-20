@section('title','Edit post')

@extends('theme')

@section('content')
    <p class="h1">Edit Type</p>
    <hr>
    <form action="{{url('posts/update/'.$ttype->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <h6>Choose Category</h6>
        <select class="form-select" name="type_id">
            @foreach($types as $type)
                <option value="{{$type -> id}}">{{$type->name_ar}} / {{$type->name_en }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label>العنوان بالانجليزي</label>
            <input type="text" class="form-control" value="{{$ttype -> name_en}}" name="title_en"
                   placeholder="Title in english">
        </div>

        <div class="form-group">
            <label>العنوان بالعربي</label>
            <input type="text" class="form-control" value="{{$ttype -> name_ar}}" name="title_ar"
                   placeholder="Title in arabic">
        </div>

        <br>
        <input type="submit" class="btn btn-primary">
    </form>
@stop
