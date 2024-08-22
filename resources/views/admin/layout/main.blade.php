<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>
    <!-- Custom fonts for this template-->
    <link href="admin_asset/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="admin_asset/css/sb-admin-2.min.css" rel="stylesheet">

    @yield('css')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.layout.navbar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    @include('admin.layout.header')
                    @yield('content')
                </div>
                @include('admin.layout.footer')
            </div>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin_asset/js/sb-admin-2.min.js"></script>
    
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="admin_asset/js/custom.js"></script>

    @yield('js')
</body>
</html>
