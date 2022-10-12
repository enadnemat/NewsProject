@section('title','Add Type')
@extends('theme')

@section('content')
    <p class="h1">Add Type</p>
    <hr>
    <form action="{{url('types/store')}}" method="post">
        @csrf
        <h6>اختر نوع الخبر</h6>
        <select class="form-select" name="type_id">
            <option value="0">فئة رئيسية / Primary type</option>
            @foreach($types as $type)
                <option value="{{$type -> id}}">{{$type->name_ar}} / {{$type->name_en}}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label>الفئة بالانجليزي</label>
            <input type="text" class="form-control" name="name_en" placeholder="Type in english">
        </div>

        <div class="form-group">
            <label>الفئة بالعربي</label>
            <input type="text" class="form-control" name="name_ar" placeholder="Type in arabic">
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Add type">

    </form>
@stop
