@extends('layouts.main')
@section('title', 'User Account | KAVA')
@section('css')
@endsection
@section('content')
<section id="userAccount">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Group</h4>
                        <button class="btn btn-success ml-3" id="addBtn" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
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
                                                <input type="checkbox" class="custom-control-input" name="id[]"
                                                    id="checkAll" value="">
                                                <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Group</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $index => $item)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" class="custom-control-input checkitem"
                                                    name="id[]" id="check{{$item->user_id}}" value="{{$item->user_id}}">
                                                <label for="check{{$item->user_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->group_name}}</td>
                                        <td>{{$item->created_at}}</td>
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
@section('modal')
{{-- AddModal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('storeAccount') }}" method="post" id="addAccountForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="form-group col-4">
                                <label for="accountName">Name</label>
                                <input type="text" name="account_name" class="form-control" id="accountName" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="accountUsername">Username</label>
                                <input type="text" name="account_username" class="form-control" id="accountUsername"
                                    required>
                            </div>
                            <div class="form-group col-4">
                                <label for="accountEmail">Email</label>
                                <input type="text" name="account_email" class="form-control" id="accountEmail" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="accountPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="accountPassword"
                                    required>
                            </div>
                            <div class="form-group col-6">
                                <label for="accountPasswordConfirmation">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="accountPasswordConfirmation" required>
                            </div>
                            <div class="form-group col-10">
                                <label for="accountGroup">Group</label>
                                <select name="account_group" id="accountGroup" class="form-control group" required>
                                    @foreach ($group as $item)
                                    <option value="{{ $item->group_id }}">{{ $item->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- EditModal --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post" id="editAccountForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="editAccountName">Name</label>
                                <input type="text" name="account_name" class="form-control" id="editAccountName">
                            </div>
                            <div class="form-group col-12">
                                <label for="editAccountEmail">Email</label>
                                <input type="text" name="account_email" class="form-control" id="editAccountEmail"
                                    disabled>
                            </div>
                            <div class="form-group col-12">
                                <label for="editAccountGroup">Group</label>
                                <select name="account_group" id="editAccountGroup" class="form-control group">
                                    @foreach ($group as $item)
                                    <option value="{{ $item->group_id }}">{{ $item->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $("#checkAll").on('change', function () {
            $(".checkitem").prop('checked', $(this).is(":checked"));
        });
        $('.checkitem').on('change', function () {
            if ($('.checkitem:checked').length !== $('.checkitem').length) {
                $('#checkAll').prop('checked', false);
            } else {
                $('#checkAll').prop('checked', true);
            }
        });

        $('.group').selectric();
        $('#editBtn').on('click', function () {
            var id = [];
            $('.checkitem:checked').each(function () {
                id.push($(this).val());
            });
            if (id.length > 1) {
                Swal.fire(
                    '',
                    "You can't edit data more than 1 at the same time!",
                    'warning'
                )
            } else if (id.length == 0) {
                Swal.fire(
                    '',
                    'Please select at least 1 data!',
                    'warning'
                )
            } else {
                $('#editAccountForm').attr('action',
                    '/user-management/account/' + id + '/edit');

                $.ajax({
                    url: "/data/account/get/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: id,
                    success: function (data) {

                        if (data['status'] == true) {
                            $('#editAccountName').val(data['account'][0].name);
                            $('#editAccountEmail').val(data['account'][0].email);
                            $('#editAccountGroup option[value="' + data['account'][0]
                                    .group_id + '"]')
                                .prop('selected', 'selected');
                            $('#editAccountGroup').selectric('refresh');

                            $('#editModal').modal('show');

                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            }
        });
    });

</script>
@endsection
