<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    @yield('title-tab')

    <style>
        /* PDF */
        @page {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .author {
            font-size: 7px;
            text-align: right;
            position: fixed;
            top: -30px;
            right: -10px;
        }

        .head-content {
            font-size: 11px;
        }

        .head-title {
            font-size: 15px;
            font-weight: bold;
        }

        .table-head {
            font-size: 11px;
            border-collapse: collapse;
            text-align: center;
        }

        .table-head tr td {
            border: 1px solid #000;
        }

        .table-content {
            /* border: 1px solid white; */
            /* background-color: red; */
        }

        .page-no {
            position: fixed;
            bottom: 0;
            right: 0;
            font-size: 9px;
        }

        thead {
            position: fixed;
        }

        .head-nominal {
            text-align: right;
        }

    </style>
</head>

<body>
    <div class="author">
        User: {{ $name }} | Print: {{ $date_now }}
    </div>
    <table border="">
        <tr>
            <td class="logo" rowspan="4" style="width: 100px; height: 100px;">
                <?php $image_path = 'storage/images/outlet_logo/thumbnails/' . $carwash_data[0]->outlet_logo ; ?>
                <img src="{{ $image_path }}" height="75px" width="75px">
            </td>
            <td class="head-title" colspan="19">REPORT @yield('title')
            </td>
        </tr>
        <tr>
            <td class="head-content" colspan="19">
                {{ $carwash_data[0]->outlet_name }}
            </td>
        </tr>
        <tr>
            <td class="head-content" colspan="19" style="padding-top: -23px;">
                {{ $carwash_data[0]->outlet_detail_address }}
            </td>
        </tr>
        @yield('title-caption')
        @yield('title-footer')
        <tr>
            <td height="5"></td>
        </tr>
    </table>

    <table class="table-head" width="100%">
        <thead>
            @yield('table-head')
            @yield('table-head-sub')
        </thead>
