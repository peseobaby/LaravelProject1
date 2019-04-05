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
                                        <a href="{{ route('edit.infor',$user->id) }}"><button class="edit">Sửa</button></a>
                                    </td>
                                </tr>
                        </table>
                        <a href="{{ route('user.staff',$user->id) }}"><button class="edit">Nhân viên cấp dưới</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
