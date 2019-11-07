@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{asset('css/icons/flaticon.css')}}">
@endsection
@section('content')
<section id="modules">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Outlet</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="wizard-steps">
                                    <div class="wizard-step wizard-step-active">
                                        <div class="wizard-step-icon">
                                            <i class="fas fa-store"></i>
                                        </div>
                                        <div class="wizard-step-label">
                                            Outlet Type
                                        </div>
                                    </div>
                                    <div class="wizard-step">
                                        <div class="wizard-step-icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="wizard-step-label">
                                            Create an Outlet
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-content my-5">
                            <div class="row justify-content-center">
                                <div class="col-6 col-sm-4 text-center">
                                    <a href="newuser/single-outlet" class="imagecheck mb-4">
                                        <figure class="imagecheck-figure">
                                            <img src="{{asset('/img/shop.png')}}" alt="}" class="imagecheck-image">
                                        </figure>
                                        <h6>Single Outlet</h6>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-4 text-center">
                                    <a href="#" class="imagecheck mb-4">
                                        <figure class="imagecheck-figure">
                                            <img src="{{asset('/img/shop.png')}}" alt="}" class="imagecheck-image">
                                            <img src="{{asset('/img/shop.png')}}" alt="}" class="imagecheck-image">
                                        </figure>
                                        <h6>Multi Outlet</h6>
                                    </a>
                                </div>
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
<script type="text/javascript" src="{{asset('/js/jquery.uploadPreview.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false // Default: false
        });
    });

</script>
@endsection
