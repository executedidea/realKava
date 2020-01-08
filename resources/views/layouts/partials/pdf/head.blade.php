<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <title>Sales Report</title>

    <style>
        /* PDF */
        table {}

        .author {
            font-size: 10px;
            text-align: right;
        }

        .head-content {
            font-size: 13px;
        }

        .head-title {
            font-size: 15px;
            font-weight: bold;
        }

        .table-head {
            font-size: 13px;
            border: 1px solid black;
        }

    </style>
</head>

<body>
    <div class="author">
        Name:['user_name']
        Print:['print_date']
    </div>
    <table border="0">

        <tr>
            <td class="logo" rowspan="4">LOGO CARWASH</td>
            <td></td>
            <td class="head-title" colspan="3">LAPORAN PENJUALAN</td>
        </tr>
        <tr>
            <td></td>
            <td class="head-content" colspan="3">['nama_carwash']</td>
        </tr>
        <tr>
            <td></td>
            <td class="head-content" colspan="3">['alamat_carwash']</td>
        </tr>
        <tr>
            <td></td>
            <td class="head-content" colspan="3">Kategori : ['jenis_kendaraan']</td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td class="head-content">Total Penjualan</td>
            <td>:</td>
        </tr>
        <tr>
            <td class="head-content">Total Penerimaan</td>
            <td>:</td>
        </tr>
        <tr>
            <td class="head-content">Sisa Penerimaan</td>
            <td>:</td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>

    </table>

    <table>
        <thead class="table-head">
            <tr>
                <td>No</td>
                <td>Customer</td>
                <td>Plat Nomor</td>
                <td>Jenis</td>
                <td>Ukuran</td>
                <td>Harga</td>
                <td>Pembayaran</td>
                <td>Sisa</td>
            </tr>
        </thead>
