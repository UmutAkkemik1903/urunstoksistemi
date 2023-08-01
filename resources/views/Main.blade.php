<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ mix('/css/app.css')}} ">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Ürün Stok</title>

    </head>
    <body class="antialiased" id="page-top">
    <div id="app"></div>
    <script src="{{ mix('/js/app.js') }}"></script>


    </body>


    <script src="{{ URL::asset('tema/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('tema/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ URL::asset('tema/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ URL::asset('tema/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('tema/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('tema/js/demo/datatables-demo.js') }}"></script>



</html>

