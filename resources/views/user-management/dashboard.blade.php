@extends('layouts.main')
@section('css')
@endsection
@section('content')
<section id="modules">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon text-dark">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-body">
                        <h4>User Group</h4>
                        <p>Add, edit, remove user group access</p>
                        <a href="{{route('userGroups')}}" class="card-cta">Go To Page<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon text-dark">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-body">
                        <h4>User Account</h4>
                        <p>Create, edit, delete user account</p>
                        <a href="{{route('userAccounts')}}" class="card-cta">Go To Page<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
