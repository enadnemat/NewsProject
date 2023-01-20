@section('title','Add photos')
@extends('theme')

@section('content')

    <p class="h1">View/Remove photos</p>
    <hr>
    <div class="container-fluid">
        <div class="m-2">
            <div id="dropzone"
                 class="dropzone">
                <div class="dz-message ">Drop files here to upload</div>
            </div>
            <br>
            <a href="{{Route('view.post')}}" class="btn btn-primary">Back to post</a>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>

    <script>
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

                init: function () {
                    // get photos
                    var myDropzone = this;
                    $.ajax({
                        url: "{{ route('get.photo', $id)}}",
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            $.each(response, function (key, value) {
                                var file = {name: value.name, size: value.size};
                                myDropzone.options.addedfile.call(myDropzone, file);
                                myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                                myDropzone.emit("complete", file);
                            });
                        },
                    });
                },
                removedfile: function (file) {
                    if (this.options.dictRemoveFile) {
                        return Dropzone.confirm("Are You Sure to " + this.options.dictRemoveFile, function () {
                            if (file.previewElement.id != "") {
                                var name = file.previewElement.id;
                            } else {
                                var name = file.name;
                            }
                            //console.log(name);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                url: '{{url('destroy')}}',
                                data: {filename: name},
                                success: function (data) {
                                    alert(data.success + " File has been successfully removed!");
                                },
                                error: function (e) {
                                    console.log(e);
                                }
                            });
                            var fileRef;
                            return (fileRef = file.previewElement) != null ?
                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        });
                    }
                },
                success: function (file, response) {
                    file.previewElement.id = response.success;
                    //console.log(file);
                    // set new posts names in dropzone’s preview box.
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                },
            })
    </script>
@stop
