@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <div class="content">
                        <h1>Danh sách nhân viên</h1>
                        <a href="{{ route('user.show', $id) }}" class ="button" >Trờ về</a> <br/> <br/>
                        <table width="100%" border="1" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Tuổi</td>
                                    <td>Địa chỉ</td>
                                    <td>Chức vụ</td>
                                    <td>Phòng ban</td>
                                </tr>
                            @foreach($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->age }}</td>
                                    <td>{{ $staff->address }}</td>
                                    <td>{{ $staff->level->name }}</td>
                                    <td>{{ $staff->department->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <br></br>
                        <button><a href="{{ route('export', $id) }}">Xuất danh sách</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
