@extends('layouts.main')
@section('title', 'Petty Cash | Point Of Sales - KAVA')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Pembelian</h4>
                </div>

                <form action="{{url('/pos/transaction/petty-cash/addpettycash')}}" method="post" id="addCustomerForm"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group text-center col-6">
                                <label for="">Saldo Petty Cash</label>
                                <input type="text" name="" class="form-control text-center" id="pettyCashAmount"
                                    value="" readonly>
                            </div>
                            <div class="form-group text-center col-6">
                                <label for="sisaBayar">Sisa Saldo</label>
                                <input type="text" name="petty_cash_detail_balanced" id="pettyCashDetailBalanced"
                                    class="form-control text-right" value="" readonly>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="date">Date Now</label>
                            <input type="date" name="petty_cash_detail_date" class="form-control" id="" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-center col-12">
                            <select name="petty_cash_detail_category" class="form-control">
                                <option disabled selected>Select Category</option>
                                <option value="work equipment">Peralatan Kerja</option>
                                <option value="operational">Operasional</option>
                                <option value="salary">Upah</option>
                                <option value="marketing">Marketing</option>
                                <option value="etc">Lain-lain</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-center col-12">
                            <input type="text" name="petty_cash_detail_amount" id="pettyCashDetailAmount"
                                class="form-control" placeholder="Jumlah Bayar">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="petty_cash_detail_desc"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary btn-block" id="Bayar">Bayar</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#pettyCashDetailAmount').on('keyup', function () {
            var result = parseInt($(this).val(), 10);
            var pettyCashAmount = parseInt($('#pettyCashAmount').val(), 10);
            $('#pettyCashDetailBalanced').val(pettyCashAmount - result);
        });
    });
    --
    }
    }


    {
        {
            --
            var rupiah = document.getElementByClassName("petty-cash-detail-amount");
            rupiah.addEventListener("keyup", function (e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, "Rp. ");
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
            }--
        }
    }

</script>
@endsection
