@extends('layouts.main')
@section('css')
@endsection
@section('content')
<section id="modules">
    <div class="container">
        <div class="row">
            @foreach ($modules as $item)
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon text-dark">
                        <i class="{{$item->modul_icon}}"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{$item->modul_name}}</h4>
                        <p>General settings such as, site title, site description, address and so on.</p>
                        <a href="{{url($item->modul_url)}}" class="card-cta">Go To Page<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
