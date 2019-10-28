@extends('layouts.app')
@section('css')
@endsection
@section('content')
<section id="customerList">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer List</h4>
                        <button class="btn btn-success ml-auto">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="btn btn-primary ml-2">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="customerTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
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
</section>
@endsection
