@extends('layouts.app_admin')
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
                        <h1>Danh sách nhân viên</h1>
                        <button data-toggle="modal" class="showModal" data-id ="0">Thêm Nhân viên</button> <br/> <br/>
                        <div class="includeModal"></div>
                        <div class="panel-body">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search">
                            <br></br>
                        </div>
                        <table id="user_table" width="100%" border="1" cellspacing="0" cellpadding="10" >
                            <thead>
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
                            </thead>
                            <tbody id="tbody">
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->age }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->level->name }}</td>
                                        <td>{{ $user->department->name }}</td>
                                        <td>
                                            <button class="showModal" data-toggle="modal" data-id ="{{ $user->id }}">Sửa</button>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <button class="delete" data-delete-id="{{ $user->id }}" >Xóa</button>
                                        </td>
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
@endsection
@section('js')
<script>
    $(function() {
        errors = @json($errors->getMessages());
        user_id =  {{ session()->has('user_id') ? session()->get('user_id') : 0 }};
    });
</script>
<script src="{{ asset('/js/user.js') }}"></script>
<style>
    #search {
        width: 140px;
        float: right;
    }
</style>
@endsection