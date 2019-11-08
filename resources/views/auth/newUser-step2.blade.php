@extends('layouts.main')
@section('title', 'Create Outlet | KAVA')
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
                                    <div class="wizard-step">
                                        <div class="wizard-step-icon">
                                            <i class="fas fa-store"></i>
                                        </div>
                                        <div class="wizard-step-label">
                                            Outlet Type
                                        </div>
                                    </div>
                                    <div class="wizard-step wizard-step-active">
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
                            <form action="{{route('newUserCreateSingleOutlet')}}" method="post" class="validate-this"
                                id="addOutletForm" enctype="multipart/form-data">
                                @csrf
                                <div class="wizard-pane">
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Logo</label>
                                        <div class="col-lg-4 col-md-6 text-center">
                                            <div id="image-preview" class="mx-auto float-lg-left">
                                                <input type="file" name="outlet_image" id="image-upload" />
                                            </div>
                                            <label for="image-upload" id="image-label"
                                                class="btn btn-secondary btn-sm mt-3 mt-lg-5 ml-lg-1">Upload
                                                Image</label>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Brand</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" name="brand" class="form-control" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Outlet Name</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" name="outlet_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Phone</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Email</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Address</label>
                                        <div class="col-lg-4 col-md-6">
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4"></div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="agree" class="custom-control-input"
                                                    id="agree" required>
                                                <label class="custom-control-label" for="agree">I agree with the <a
                                                        href="#"> Terms
                                                        and
                                                        Conditions</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4"></div>
                                        <div class="col-lg-4 col-md-6 text-center">
                                            <button type="submit" class="btn btn-primary">Create Outlet</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            label_selected: "Change Image", // Default: Change File
            no_label: false // Default: false
        });
    });

</script>
@endsection
