@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
<section id="openStore">
    <div class="container">
        @if(Session::has('storeOpened'))
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>The store is open now!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Open Store</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeOpenStore') }}" method="post" id="openStoreForm">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="form-group col-10">
                                    <label for="">Cashier Name</label>
                                    <input type="text" name="cashier_name" class="form-control"
                                        value="Alfathya Dzisulthani" readonly>
                                </div>
                                <div class="form-group col-10">
                                    <label for="lastCashDrawer">Last Cash Drawer</label>
                                    <input type="text" name="last_cashdrawer" class="form-control text-right"
                                        id="lastCashDrawer" value="20000" readonly>
                                </div>
                                <div class="form-group col-10">
                                    <label for="openDate">Open Date</label>
                                    <input type="text" name="open_date" class="form-control datepicker" id="openDate">
                                </div>
                                <div class="form-group col-10">
                                    <label for="openCashDrawer">Opening Cash Drawer</label>
                                    <input type="text" name="open_cashdrawer" class="form-control text-right rupiah"
                                        id="openCashDrawer" placeholder="0">
                                </div>
                                <div class="form-group col-10">
                                    <label for="totalCashDrawer">Total Cash Drawer</label>
                                    <input type="text" name="total_cashdrawer" class="form-control text-right rupiah"
                                        value="0" id="totalCashDrawer" readonly>
                                </div>
                                <div class="form-group col-10">
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#openCashDrawer').on('keyup', function () {
            var result = parseInt($(this).val(), 10);
            var lastCashDrawer = parseInt($('#lastCashDrawer').val(), 10);
            $('#totalCashDrawer').val(result + lastCashDrawer);
        });
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY/MM/DD'
            }
        });

        $('#openStoreForm').on('submit', function () {

        });

    });

</script>
@endsection
