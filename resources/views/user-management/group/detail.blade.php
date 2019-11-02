@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('/modules/jquery-selectric/selectric.css')}}">
@endsection
@section('content')
<section id="groupDetail">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @foreach($outlet as $item)
                <div class="card card-large-icons">
                    <div class="card-icon">
                        <i class="fa fa-user module-icon"></i>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12 col-lg-6">
                                <label for="outletName">Outlet Name</label>
                                <input type="text" class="form-control" value="{{$item->outlet_detail_name}}" disabled>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="outletName">Brand</label>
                                <input type="text" class="form-control" value="{{$item->outlet_name}}" disabled>
                            </div>
                            <div class="form-group col-12">
                                <label for="outletName">Address</label>
                                <input type="text" class="form-control" value="{{$item->outlet_detail_address}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3 align-self-center text-center">
                                <img src="{{asset('img/avatar/avatar-1.png')}}" alt="" class="rounded-circle"
                                    height="70px">
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="form-group">
                                    <label for="outletName">Group</label>
                                    <input type="text" class="form-control" value="{{$group}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Permission</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <form method="get" id="moduleForm">
                                <input type="hidden" name="outlet" value="{{Auth::user()->outlet_id}}">
                                <div class="form-group col-12">
                                    <label class="form-label">Modules</label>
                                    <div class="selectgroup w-100">
                                        @foreach ($modules as $item)
                                        <label class="selectgroup-item">
                                            <input type="radio" name="module" value="{{$item->modul_id}}"
                                                class="selectgroup-input"
                                                {{ Request::get('module') == $item->modul_id ? 'checked' : '' }}>
                                            <span
                                                class="selectgroup-button text-capitalize">{{$item->modul_name}}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="get">
                                    <table class="table table-striped" id="rightsTable">
                                        <thead>
                                            <tr>
                                                <th>Menu</th>
                                                <th>Add</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                <th>Read</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($menu_detail as $index => $item)
                                            <tr>
                                                <td>{{$item->menu_detail_name}}</td>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="hidden"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            value="0">
                                                        <input type="checkbox" data-checkboxes="rights"
                                                            class="custom-control-input"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            id="print{{$item->menu_detail_id}}" value="1">
                                                        <label for="print{{$item->menu_detail_id}}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="hidden"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            value="0">
                                                        <input type="checkbox" data-checkboxes="rights"
                                                            class="custom-control-input"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            id="print{{$item->menu_detail_id}}" value="2">
                                                        <label for="print{{$item->menu_detail_id}}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="hidden"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            value="0">
                                                        <input type="checkbox" data-checkboxes="rights"
                                                            class="custom-control-input"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            id="print{{$item->menu_detail_id}}" value="3">
                                                        <label for="print{{$item->menu_detail_id}}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="hidden"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            value="0">
                                                        <input type="checkbox" data-checkboxes="rights"
                                                            class="custom-control-input"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            id="print{{$item->menu_detail_id}}" value="4">
                                                        <label for="print{{$item->menu_detail_id}}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="hidden"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            value="0">
                                                        <input type="checkbox" data-checkboxes="rights"
                                                            class="custom-control-input"
                                                            name="right[right_code][{{$item->menu_detail_id}}][]"
                                                            id="print{{$item->menu_detail_id}}" value="5">
                                                        <label for="print{{$item->menu_detail_id}}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{asset('/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#selectModule').selectric();
        $('.selectgroup-item').on('click', function () {
            $('#moduleForm').submit();
        });
    });

</script>
@endsection
