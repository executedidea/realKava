@extends('layouts.main')
@section('css')
@endsection
@section('content')
<section id="userGroup">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Group</h4>
                        <a href="{{route('addGroup')}}" class="btn btn-success ml-3">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </a>
                        <button class="btn btn-info ml-1" id="editBtn">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger ml-1" id="deleteBtn">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                        <h4 class="ml-auto">Export to:</h4>
                        <a href="http://" class="ml-1">
                            <img src="{{asset('img/icons/pdf.png')}}" class="" alt="" height="50px">
                        </a>
                        <a href="http://" class="ml-1">
                            <img src="{{asset('img/icons/excel.png')}}" class="ml-1" alt="" height="50px">
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="groupTable">
                                <thead>
                                    <tr>
                                        <th class="th-sm text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input" name="id[]" id="checkAll" value="">
                                                <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Group Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groups as $index => $item)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="rights"
                                                    class="custom-control-input checkitem" name="id[]"
                                                    id="check{{$item->group_id}}" value="">
                                                <label for="check{{$item->group_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{$item->group_name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{asset('js/page/user-management/group/index.js')}}"></script>
<script src="{{asset('/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script>
    $("#checkAll").on('change', function () {
        $(".checkitem").prop('checked', $(this).is(":checked"));
    });
    $('#editCustomer').on('click', function () {
        var id = [];
        $('.checkitem:checked').each(function () {
            id.push($(this).val());
        });
        if (id.length > 1) {
            Swal.fire(
                "You can't edit data more than 1 at the same time!",
                '',
                'warning'
            )
        } else if (id.length == 0) {
            Swal.fire(
                'Please select at least 1 data!',
                '',
                'warning'
            )
        } else {
            window.location = "/user-management/group"
        }
    });

</script>
@endsection
