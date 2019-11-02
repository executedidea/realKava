@extends('layouts.main')
@section('css')
@endsection
@section('content')
<section id="userGroup">
    <div class="container">
        <div class="row justify-content-center">
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
