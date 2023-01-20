<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
          integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <style>
        label.error {
            color: red;
            font-size: small;
        }

        .dz-image img {
            width: 100%;
            height: 100%;
        }

        .dropzone.dz-started .dz-message {
            display: block !important;
        }

        .dropzone {
            border: 2px dashed #028AF4 !important;;
        }

        .dropzone .dz-preview.dz-complete .dz-success-mark {
            opacity: 1;
        }

        .dropzone .dz-preview.dz-error .dz-success-mark {
            opacity: 0;
        }

        .dropzone .dz-preview .dz-error-message {
            top: 144px;
        }

        .dz-message1 {
            opacity: 0.5;
            font-size: 12px;
        }
    </style>

</head>
<body class="sb-nav-fixed">
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="{{url('logout')}}"
                   class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Logout</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="{{Route('view.post')}}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 text-white d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span
                                class="ms-1 text-white d-none d-sm-inline">Post</span> </a>
                        <ul class="collapse show nav flex-column ms-4" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100 ">
                                <a href="{{Route('add.post')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Add posts</span></a>
                            </li>
                            <li>
                                <a href="{{Route('view.post')}}" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline">View all posts</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span
                                class="ms-1 text-white d-none d-sm-inline">Types</span> </a>
                        <ul class="collapse show nav flex-column ms-4" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="{{url('types/add')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Add types</span></a>
                            </li>
                            <li>
                                <a href="{{url('types/view')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">View all types</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</body>
</html>
