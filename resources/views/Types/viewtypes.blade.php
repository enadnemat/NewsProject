@section('title','View types')
@extends('theme')
@section('content')
    <p class="h1">View all Types</p> <p>

    <hr>
    <table id="type" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>Type in arabic</th>
            <th>Type in english</th>
            <th>Post Number</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        {{--                    <a href="{{url('types/delete/'.$type->id)}}" id="delete" class="btn btn-sm btn-danger"--}}
        {{--                       data-confirm="Are you sure? This action will delete all the data that is related to it">--}}
        {{--                        Delete</a>--}}
        {{--
        {{--                    <a href="{{url('types/edit/'.$type->id)}}" class="btn btn-sm btn-primary">Edit</a>--}}
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#type').dataTable({
                processing: true,
                serverSide: true,
                ajax: "{{  Route('get.Type') }}",
                columns: [
                    {data: "id", name: "id" , "visible": false},
                    {data: "name_ar", name: "name_ar"},
                    {data: "name_en", name: "name_en"},
                    {data: "posts_count", name: "posts_count", "searchable": false},
                    {data: "delete", name: "delete", "searchable": false},
                    {data: "edit", name: "edit", "searchable": false},

                ]
            });
        });

    </script>
@endsection

