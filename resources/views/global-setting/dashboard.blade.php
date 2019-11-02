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
                        <h4>Single Outlet</h4>
                        <p>Add, edit, remove single outlet</p>
                        <a href="{{url('global-setting/single-outlet')}}" class="card-cta">Go To Page<i
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
                        <h4>Multi Outlet</h4>
                        <p>Create, edit, delete multi outlet</p>
                        <a href="{{url('global-setting/multi-outlet')}}" class="card-cta">Go To Page<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
