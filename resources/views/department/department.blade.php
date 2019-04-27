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
                    <button id ="addDepartment" >Thêm phòng ban</button> <br/> <br/>
                    <table width="100%" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Tên phòng ban</td>
                                <td>Options</td>
                            </tr>
                        </thead>
                        <tbody class="tbodyDepartment">
                            @foreach($danhsach as $ds)
                                <tr>
                                    <td name = "id">{{ $ds->id }}</td>
                                    <td name = "name">{{ $ds->name }}</td>
                                    <td>
                                        <button class="editDepartment">Sửa</button>
                                        <a href="{{ route('department.show',$ds->id) }}"><button class="show">Danh sách</button>
                                        </a>
                                        <form action="{{ asset('') }}department/{{ $ds->id }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="delete">Xóa</button>
                                        </form>
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
@endsection
@section('js')
<script src="{{ asset('/js/department.js') }}">
    
</script>
@endsection