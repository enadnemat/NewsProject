@section('title','View post')
@extends('theme')
@section('content')
    <p class="h1">View all posts</p> <p>
        الأخبار:
        <br>
        1) حوادث سير
        <br>
        2)جرائم قتل
        <br>
        3)كرة قدم
    </p>


    <hr>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>العنوان بالعربي</th>
            <th>العنوان بالانجليزي</th>
            <th>الوصف بالعربي</th>
            <th>الوصف بالانجليزي</th>
            <th>Photo</th>
            <th>نوع الخبر</th>
            <th>حذف</th>
            <th>تعديل</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title_ar }}</td>
                <td>{{ $post->title_en }}</td>
                <td>{{ $post->description_ar }}</td>
                <td>{{ $post->description_en }}</td>
                <td><img width="50" style="height: auto" src="{{asset('images/posts/'.$post->photo)}}" alt="Not found">
                </td>

                <td>{{ $post ->type_id }}</td>
                <td>
                    <form method="get" action="{{url('posts/delete/'.$post->id)}}">
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                    </form>
                </td>
                <td><a href="{{url('posts/edit/'.$post->id)}}" class="btn btn-sm btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
