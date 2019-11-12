<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
@yield('meta')
<title>@yield('title')</title>

{{-- General CSS Files --}}
<link rel="stylesheet" href="{{asset('/modules/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('/modules/fontawesome/css/all.min.css')}}">

{{-- CSS Libraries --}}
<link rel="stylesheet" href="{{asset('/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/modules/jquery-selectric/selectric.css')}}">

@yield('css')

{{-- Template CSS File --}}
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
<link rel="stylesheet" href="{{asset('/css/components.css')}}">
<link rel="stylesheet" href="{{asset('/css/custom.css')}}">

{{-- JS --}}
<script src="{{asset('/modules/jquery.min.js')}}"></script>
