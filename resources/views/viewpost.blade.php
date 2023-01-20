@section('title','View post')
@extends('theme')
@section('content')
    <p class="h1">View all posts</p>

    <hr>
    <table id="post" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>Title in arabic</th>
            <th>Title in english</th>
            <th>Description in arabic</th>
            <th>Description in english</th>
            <th>Category</th>
            <th>Photos count</th>
            <th>View Photos</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
        </thead>
        <tbody>
        {{--<td><img width="50" style="height: auto" src="{{asset('posts/posts/'.$posts->photo)}}" alt="Not found"></td>--}}
        {{--<td>{{$posts->type->name_en}}</td>--}}
        {{--<td>--}}
        {{--    <form method="get" action="{{url('posts/delete/'.$posts->id)}}">--}}
        {{--        @csrf--}}
        {{--        <input type="submit" value="Delete" class="btn btn-sm btn-danger">--}}
        {{--    </form>--}}
        {{--</td>--}}
        {{--<td><a href="{{url('posts/edit/'.$posts->id)}}" class="btn btn-sm btn-primary">Edit</a>--}}

        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#post').dataTable({
                processing: true,
                serverSide: true,
                ajax: location.href,
                columns: [
                    {data: "id", name: "id", },
                    {data: "title_ar", name: "title_ar"},
                    {data: "title_en", name: "title_en"},
                    {data: "description_ar", name: "description_ar"},
                    {data: "description_en", name: "description_en"},
                    {data: "type.name_en", name: "type.name_en"},
                    {data: "photos_count", name: "photos_count", "searchable": false},
                    {data: "viewPhoto", name: "viewPhoto", "searchable": false},
                    {data: "edit", name: "edit", "searchable": false},
                    {data: "delete", name: "delete", "searchable": false},

                ]
            });
        });


        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            var table = $('#post').DataTable();
            var post_id = $(this).attr('post_id');
            console.log(post_id);
            $.ajax({
                type: 'post',
                url: "{{Route('delete.posts')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': post_id,
                },
                success: function (data) {
                    console.log(table);
                    table.ajax.reload();
                },
                error: function (reject) {
                },
            });
        })

    </script>
    {{--    <script>--}}
    {{--        Dropzone.autoDiscover = false;--}}
    {{--        var dropzone = new Dropzone ("div#myDropzone",{--}}
    {{--            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
    {{--            url: '{{Route('store.photo')}}',--}}
    {{--            method:"post",--}}
    {{--            autoProcessQueue: false,--}}
    {{--            uploadMultiple: true,--}}
    {{--            parallelUploads: 100,--}}
    {{--            maxFilesize: 3,--}}
    {{--            maxFiles: 15,--}}
    {{--            addRemoveLinks: true,--}}
    {{--            acceptedFiles: ".jpeg,.jpg,.png,.gif",--}}

    {{--            init: function (){--}}
    {{--                var myDropzone =this;--}}

    {{--                this.element.querySelector("button[type=submit]").addEventListener("click", function(e){--}}
    {{--                    e.preventDefault();--}}
    {{--                    e.stopPropagation();--}}
    {{--                    myDropzone.processQueue();--}}
    {{--                });--}}



    {{--                this.on("sendingmultiple", function() {--}}
    {{--                    // Gets triggered when the form is actually being sent.--}}
    {{--                    // Hide the success button or the complete form.--}}
    {{--                });--}}
    {{--                this.on("successmultiple", function(files, response) {--}}
    {{--                    // Gets triggered when the files have successfully been sent.--}}
    {{--                    // Redirect user or notify of success.--}}
    {{--                });--}}
    {{--                this.on("errormultiple", function(files, response) {--}}
    {{--                    // Gets triggered when there was an error sending the files.--}}
    {{--                    // Maybe show form again, and notify user of error--}}
    {{--                });--}}
    {{--            }--}}

    {{--        })--}}
    {{--    </script>--}}

@endsection

