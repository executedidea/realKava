@extends('layouts.main')
@section('css')

@endsection
@section('content')
<section id="localSetting">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Setting Number</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="batchOption">Batch</label>
                                <div class="custom-checkbox custom-control">
                                    <input type="radio" class="custom-control-input" name="batch" id="monthlyBatch"
                                        value="" checked>
                                    <label for="monthlyBatch" class="custom-control-label">Monthly</label>
                                </div>
                                <div class="custom-checkbox custom-control">
                                    <input type="radio" class="custom-control-input" name="batch" id="yearlyBatch"
                                        value="">
                                    <label for="yearlyBatch" class="custom-control-label">Yearly</label>
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
