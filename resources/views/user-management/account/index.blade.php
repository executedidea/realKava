
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
                        <button class="btn btn-success ml-3" id="addBtn">
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
                                                <input type="checkbox"
                                                    class="custom-control-input" name="id[]" id="checkAll" value="">
                                                <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $index => $item)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox"
                                                    class="custom-control-input checkitem" name="id[]"
                                                    id="check{{$item->user_id}}" value="{{$item->user_id}}">
                                                <label for="check{{$item->user_id}}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
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
{{-- EditModal --}}
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <div class="modal-body">
                <div class="container-fluid">
                    Add rows here
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>   
@endsection
@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
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
            window.location = "/user-management/group/"+id;
        }
    });

</script>
@endsection
