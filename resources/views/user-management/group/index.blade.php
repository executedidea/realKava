@extends('layouts.main')
@section('css')
@endsection
@section('content')
<section id="userGroup">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3 align-self-center text-center">
                                <img src="{{asset('img/avatar/avatar-1.png')}}" alt="" class="rounded-circle"
                                    height="100px">
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="outletName">Branch</label>
                                        <input type="text" class="form-control" id="outletName" value="Piston Lab"
                                            disabled>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="outletBrand">Brand</label>
                                        <input type="text" class="form-control" id="outletBrand" value="Piston Lab"
                                            disabled>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="outletBrand">Address</label>
                                        <input type="text" class="form-control" id="outletBrand"
                                            value="Jln Soekarno Hatta Bandung" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Group</h4>
                        <button class="btn btn-success ml-auto">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="btn btn-danger ml-1">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="groupTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Group Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{asset('js/page/user-management/group/index.js')}}"></script>
<script src="{{asset('/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
@endsection
