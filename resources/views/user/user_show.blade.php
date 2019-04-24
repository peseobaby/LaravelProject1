@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    @if (session('alert'))
                        <div class="alert alert-success">
                            {{ session('alert') }}
                        </div>
                    @endif
                    <div class="content">
                        <h1>Thông tin nhân viên {{ $user->name }}</h1>
                        
                        <table width="100%" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Tuổi</td>
                                <td>Địa chỉ</td>
                                <td>Chức vụ</td>
                                <td>Phòng ban</td>
                                <td>Options</td>
                            </tr>
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->age }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->level->name }}</td>
                                <td>{{ $user->department->name }}</td>
                                <td>
                                    <button class="edit" data-toggle="modal" data-target="#editUserInfor" data-name = "{{ $user
                                    ->name }}" data-age ="{{ $user->age }}" data-address ="{{ $user->address }}">Sửa</button>
                                </td>
                            </tr>
                        </table>
                        <a href="{{ route('user.staff',$user->id) }}"><button class="edit">Nhân viên cấp dưới</button></a>
                    </div>
                    @include('user.modal_edit_infor', ['id' => $user->id])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script >
$(document).ready(function() {
    $("#editUserInfor").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var name = button.data("name");
        var age = button.data("age");
        var address = button.data("address");
        var modal = $(this);
        modal.find(".modal-body #name").val(name);
        modal.find(".modal-body #age").val(age);
        modal.find(".modal-body #address").val(address);
    });
});
</script>
@endsection
