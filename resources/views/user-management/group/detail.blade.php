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
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3 align-self-center text-center">
                                <img src="{{asset('img/avatar/avatar-1.png')}}" alt="" class="rounded-circle"
                                    height="100px">
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
                        <div class="row">
                            <div class="form-group col-12 col-lg-6">
                                <select name="module" class="form-control" id="selectModule">
                                    <option disabled selected>
                                        --- Select Module ---
                                    </option>
                                    @foreach ($modules as $item)
                                    <option value="{{$item->modul_id}}" data-id="{{$item->modul_id}}">
                                        {{$item->modul_name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                            <tr></tr>
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
        $('#selectModule').on('change', function () {
            var id = $(this).val();
            var url = `/user-management/group/admin?module=` + id;

            window.location = url;
        });
    });

</script>
@endsection
