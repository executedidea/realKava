@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{asset('/css/kava/default.css')}}">
@endsection
@section('content')
<section id="localSetting">
    <div class="container">
        <form action="{{ route('storePOSLocalSetting') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Number Setting</h4>
                            <button type="button" class="btn btn-info ml-1" id="editSetting">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-title">Batch</div>
                                </div>
                                <div class="form-group col-3">
                                    <div class="custom-checkbox custom-control">
                                        <input type="radio" class="custom-control-input" name="batch" id="monthlyBatch"
                                            value="m"
                                            {{ ($condition === 1 && $setting[0]->setting_pos_batchNo == 'm') ? 'checked disabled' : '' }}>
                                        <label for="monthlyBatch" class="custom-control-label">Monthly</label>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <div class="custom-checkbox custom-control">
                                        <input type="radio" class="custom-control-input" name="batch" id="yearlyBatch"
                                            {{ ($condition === 1 && $setting[0]->setting_pos_batchNo == 'y') ? 'checked disabled' : '' }}>
                                        <label for="yearlyBatch" class="custom-control-label">Yearly</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-title">Petty Cash</div>
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" name="pettycash_code" class="form-control" id="pettyCashCode"
                                        placeholder="Code"
                                        {{ ($condition === 1) ? 'value='.$setting[0]->setting_pos_code_pc.' disabled' : '' }}>
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" name="pettycash_number" class="form-control" id="pettyCashNumber"
                                        placeholder="Number"
                                        {{ ($condition === 1) ? 'value='.$setting[0]->setting_pos_no_pc.' disabled' : '' }}>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-title">Cash Detail</div>
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" name="cashdetail_code" class="form-control" id="cashDetailCode"
                                        placeholder="Code"
                                        {{ ($condition === 1) ? 'value='.$setting[0]->setting_pos_code_cd.' disabled' : '' }}>
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" name="cashdetail_number" class="form-control"
                                        id="cashDetailNumber" placeholder="Number"
                                        {{ ($condition === 1) ? 'value='.$setting[0]->setting_pos_no_cd.' disabled' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Finance Setting</h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="section-title">Credit Card Charge</div>
                                </div>
                                <div class="form-group col-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cc_charge" id="ccMCCharge"
                                            placeholder="Master Card"
                                            {{ ($condition === 1) ? 'value='.$setting[0]->setting_pos_ccCharge_mc.' disabled' : '' }}>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cc_charge" id="ccMCCharge"
                                            placeholder="Visa"
                                            {{ ($condition === 1) ? 'value='.$setting[0]->setting_pos_ccCharge_visa.' disabled' : '' }}>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6 text-center">
                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" value="1" name="ppn" class="custom-switch-input"
                                                {{ ($condition === 1 && $setting[0]->setting_pos_ppn == 1) ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">PPN 10%</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-block"
                                {{ ($condition === 1) ? 'disabled' : '' }}>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#editSetting').on('click', function () {
            $('input').prop('disabled', false);
            $('button').prop('disabled', false);
        });
    });

</script>
@endsection
