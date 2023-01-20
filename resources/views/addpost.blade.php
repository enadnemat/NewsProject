@section('title','Add post')
@extends('theme')

@section('content')

    <p class="h1">Add post</p>
    <hr>
    <div class="container-fluid">
        <div class="m-2">
            <form method="post" enctype='multipart/form-data' id="postForm" name="postForm">
                @csrf
                <h6>Choose post type</h6>
                <div class="input-control">
                    <select class="form-select" id="type-dropdown" name="type_id" required>
                        @foreach($types->whereNull('type_id') as $type)
                            @if($type)
                                <option value="{{$type -> id}}">{{$type->name_ar}}/{{$type->name_en}} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="input-control">
                    <select class="form-select" id="sub_type" name="sub_type">
                    </select>
                </div>

                <div class="form-group">
                    <label for="title_en">العنوان بالانجليزي</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" required
                           placeholder="Title in english">
                </div>

                <div class="form-group">
                    <label for=title_ar>العنوان بالعربي</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" required
                           placeholder="Title in arabic">
                </div>

                <div class="form-group">
                    <label for="description_en">الوصف بالانجليزي</label>
                    <textarea name="description_en" id="description_en" class="form-control"
                              cols="20" rows="5"
                              required placeholder="Description in english"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label for="description_ar">الوصف بالعربي</label>
                    <textarea name="description_ar" id="description_ar" class="form-control"
                              cols="20" rows="5"
                              required placeholder="Description in arabic"></textarea>
                </div>
                <div class="form-group">
                    <label>Select images</label>
                    <div class="dropzone" id="dropzone">
                    </div>
                </div>

                <button type="submit" id="store" class="btn btn-primary mt-2">Add Post</button>
            </form>
            <br>

        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <script>

        var preventDefault = false;
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#dropzone",
            {
                url: "#",
                autoProcessQueue: false,
                paramName: "dropzone",
                dictDefaultMessage: 'Drop or drop/Click to upload<span class="dz-message1"> Max: 5 files</span>',
                maxFiles: 8,
                maxFilesize: 4, //MB
                // renameFile: function(file) {
                // var dt = new Date();
                // var time = dt.getTime();
                // return time+"-"+file.name;    // to rename file name but i didn't use it. i renamed file with php in controller.
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
            });


        $("#postForm").validate({
            rules: {
                title_en: "required",
                title_ar: "required",
                description_en: "required",
                description_ar: "required",
            },
            messages: {
                title_en: "Please enter the title",
                title_ar: "Please enter the title",
                description_en: "Please enter the description",
                description_ar: "Please enter the description",
            },
            submitHandler: function (form) {

                var formData = new FormData(document.forms['postForm']);

                $(myDropzone.files).each(function (i, file) {
                    formData.append('photos[]', file);
                });

                $.ajax({
                    url: "{{Route('store.post')}}",
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#postForm').trigger("reset");
                       location.href = "{{Route('view.post')}}";
                    },
                    error: function (reject) {
                    },
                });
            },
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#type-dropdown').on('change', function () {
                var id = this.value;
                $("#sub_type").html('');
                $.ajax({
                    url: "{{url('posts/fetchType')}}",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}',
                        type_id: id,
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#sub_type').html('<option value="">-- Select Sub Type --</option>');
                        $.each(result.types, function (key, value) {
                            $("#sub_type").append('<option value="' + value
                                .id + '">' + value.name_en + ' / ' + value.name_ar + '</option>');
                        });
                    }
                })
            })
        });
    </script>
@stop
