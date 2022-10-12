<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="resources/css/styles.css" rel="stylesheet"/>

</head>
<body class="sb-nav-fixed">
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="{{url('viewpost')}}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 text-white d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span
                                class="ms-1 text-white d-none d-sm-inline">Post</span> </a>
                        <ul class="collapse show nav flex-column ms-4" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100 ">
                                <a href="{{url('posts/add')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Add posts</span></a>
                            </li>
                            <li>
                                <a href="{{url('viewpost')}}" class="nav-link px-0"> <span
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
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
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
<script src="resources/assets/demo/chart-area-demo.js"></script>
<script src="resources/assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="resources/js/datatables-simple-demo.js"></script>
</body>
</html>
