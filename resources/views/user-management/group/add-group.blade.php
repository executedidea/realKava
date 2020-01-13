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
                    <div class="card-icon outlet-card">
                        <div class="circular">
                            <img src="{{asset('storage/images/outlet_logo/thumbnails/'.$item->outlet_logo)}}"
                                alt="{{$item->outlet_logo}}">
                        </div>
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
        <form method="post" action="{{route('addGroupPost', ['outlet'=> 2])}}" class="validate-this">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-3 align-self-center text-center">
                                    <img src="{{asset('img/avatar/avatar-1.png')}}" alt="" class="rounded-circle"
                                        height="70px">
                                </div>
                                @csrf
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="outletName">Group Name</label>
                                        <input type="text" class="form-control" name="group_name" value="">
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
                            <h4 class="d-block">Modules</h4>
                            <ul class="nav nav-pills mx-auto" id="myTab3" role="tablist">
                                @foreach ($allModules as $item)
                                <li class="nav-item">
                                    <a class="nav-link text-capitalize" id="module{{$item->modul_id}}" data-toggle="tab"
                                        href="#content{{$item->modul_id}}" role="tab"
                                        aria-controls="{{$item->modul_id}}"
                                        aria-selected="true">{{$item->modul_name}}</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="modulContent1">
                                <div class="tab-pane fade" id="content1" role="tabpanel" aria-labelledby="module1">
                                    <table class="table table-striped" id="menuCS"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_cs as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                                <div class="tab-pane fade" id="content2" role="tabpanel" aria-labelledby="module2">
                                    <table class="table table-striped" id="menuPOS"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_pos as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                                <div class="tab-pane fade" id="content3" role="tabpanel" aria-labelledby="module3">
                                    <table class="table table-striped" id="menuSAM"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_sam as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                                <div class="tab-pane fade" id="content4" role="tabpanel" aria-labelledby="module4">
                                    <table class="table table-striped" id="menuEMP"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_emp as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                                <div class="tab-pane fade" id="content5" role="tabpanel" aria-labelledby="module5">
                                    <table class="table table-striped" id="menuPCS"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_pcs as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                                <div class="tab-pane fade" id="content6" role="tabpanel" aria-labelledby="module6">
                                    <table class="table table-striped" id="menuGS"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_gs as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                                <div class="tab-pane fade" id="content7" role="tabpanel" aria-labelledby="module7">
                                    <table class="table table-striped" id="menuUM"">
                                            <thead>
                                                <tr>
                                                    <th>Modul</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Read</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu_detail_um as $item)
                                                <tr>
                                                    <td class=" pl-3">{{$item->menu_detail_name}}</td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem-add"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="add{{$item->menu_detail_id}}" value="1">
                                                <label for="add{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="right[right_code][{{$item->menu_detail_id}}][]"
                                                value="0">
                                            <div class="custom-checkbox custom-control">

                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="edit{{$item->menu_detail_id}}" value="2">
                                                <label for="edit{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="delete{{$item->menu_detail_id}}" value="3">
                                                <label for="delete{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]"
                                                    id="read{{$item->menu_detail_id}}" value="4">
                                                <label for="read{{$item->menu_detail_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="hidden"
                                                    name="right[right_code][{{$item->menu_detail_id}}][]" value="0">
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
                                </div>
                            </div>
                            <div class="form-group text-right mt-4">
                                <button class="btn btn-primary btn-lg ml-auto">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</section>
@endsection
@section('script')
<script src="{{asset('/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script src="{{asset('/js/kava/validation.js')}}"></script>
<script>
    $("#checkAdd").on('click', function () {
        $(".checkitem-add").prop('checked', $(this).is(":checked"));
    });

</script>
@endsection
