@section('title','Add Type')
@extends('theme')

@section('content')
    <p class="h1">Add Type</p>
    <hr>
    <form method="post" id="typeForm">
        @csrf
        <h6>اختر الفئة</h6>
        <select  class="form-select" name="type_id" id="type_id">
            <option value="">فئة رئيسية / Primary type</option>
            @foreach($types->whereNull('type_id') as $type)
                @if($type)
                    <option id="myselection" value="{{$type -> id}}">{{$type->name_ar}} / {{$type->name_en}}</option>
                @endif
            @endforeach
        </select>

        <div class="form-group">
            <label>الفئة بالانجليزي</label>
            <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Type in english" required>
        </div>

        <div class="form-group">
            <label>الفئة بالعربي</label>
            <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Type in arabic" required>
        </div>

        <br>
        <button type="submit" class="btn btn-primary"  id="store">Add Type</button>

    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $("#typeForm").validate({
            rules: {
                name_en: "required",
                name_ar: "required",
            },
            messages: {
                name_en: "Please enter the type name",
                name_ar: "Please enter the type name in arabic",
            },

            submitHandler: function (form) {
                var formData = new FormData($('#typeForm')[0]);
                console.log(formData);
                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{url('types/store')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (data) {
                        $('#typeForm').trigger("reset");
                    },
                    error: function (reject) {
                    },
                });
            },
        });

    </script>

@stop
