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
                        <button id = "addUser">Thêm Nhân viên</button> <br/> <br/>
                        <table width="100%" border="1" cellspacing="0" cellpadding="10">
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
                            <tbody class="tbody">
                                @foreach($danhsach as $ds)
                                    <tr >
                                        <td name = "id">{{ $ds->id }}</td>
                                        <td name = "name">{{ $ds->name }}</td>
                                        <td name = "email">{{ $ds->email }}</td>
                                        <td name = "age">{{ $ds->age }}</td>
                                        <td name = "address"> {{ $ds->address }}</td>
                                        <td>{{ $ds->level->name }}</td>
                                        <td name = "level" hidden>{{ $ds->level_id }}</td>
                                        <td>{{ $ds->department->name }}</td>
                                        <td name = "department" hidden>{{ $ds->department_id }}</td>
                                        <td>
                                            <button class="edit" >Sửa</button>
                                            <form action="{{ route('user.destroy', $ds->id) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
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
</div>
@endsection
@section('js')
<script>
    levels = @json($levels);
    departments = @json($departments);
</script>
<script type="text/javascript" src="{{ asset('/js/user.js') }}"></script>
@endsection
