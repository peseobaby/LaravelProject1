@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <div class="content">
                        <h1>Danh sách nhân viên phòng ban {{ $department->name }}</h1>
                        <a href="{{ route('department') }}">Trở về</a>
                        <table width="100%" border="1" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Tuổi</td>
                                    <td>Địa chỉ</td>
                                    <td>Chức vụ</td>
                                </tr>
                            @foreach($danhsach as $ds)
                                <tr>
                                    <td>{{ $ds->id }}</td>
                                    <td>{{ $ds->name }}</td>
                                    <td>{{ $ds->email }}</td>
                                    <td>{{ $ds->age }}</td>
                                    <td>{{ $ds->address }}</td>
                                    <td>{{ $ds->level->name }}</td>
                                </tr>
                            @endforeach                                      
                        </table>
                        <a href=""><button class="excel">Xuất danh sách</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
