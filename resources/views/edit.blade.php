@section('title','Edit post')

@extends('theme')

@section('content')
    <p class="h1">Edit post</p>
    <hr>
    <form action="{{url('posts/update/'.$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <h6>اختر نوع الخبر</h6>
        <select class="form-select" name="type_id">
            @foreach($types as $type)
                <option value="{{$type -> id}}">{{$type->name_ar}} / {{$type->name_en }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label>العنوان بالانجليزي</label>
            <input type="text" class="form-control" value="{{$post -> title_en}}" name="title_en"
                   placeholder="Title in english">
        </div>

        <div class="form-group">
            <label>العنوان بالعربي</label>
            <input type="text" class="form-control" value="{{$post -> title_ar}}" name="title_ar"
                   placeholder="Title in arabic">
        </div>
        <div class="form-group">
            <label>الوصف بالانجليزي</label>
            <textarea name="description_en" class="form-control" cols="20" rows="5"
                      placeholder="Description in english">{{$post -> description_en}}</textarea>
        </div>
        <div class="form-group">
            <label>الوصف بالعربي</label>
            <textarea name="description_ar" class="form-control" cols="20" rows="5"
                      placeholder="Description in arabic">{{$post -> description_ar}}</textarea>
        </div>
        <br>
        <input type="submit" class="btn btn-primary">
    </form>
@stop
