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
                    <h1>Danh sách phòng ban</h1>
                    <button data-toggle="modal" class="showModalDepartment" data-id ="0">Thêm phòng ban</button> <br/> <br/>
                    <div class="includeModalDepartment"></div>
                    <table width="100%" border="1" cellspacing="0" cellpadding="10">
                        <input type="text" name="search_department" id="search_department" class="form-control" placeholder="Search">
                        <br></br>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Tên phòng ban</td>
                                <td>Options</td>
                            </tr>
                        </thead>
                        <tbody id ="tbody1">
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>
                                        <button class="showModalDepartment" data-id ="{{ $department->id }}">Sửa</button>
                                        <a href="{{ route('department.show',$department->id) }}"><button class="show">Danh sách
                                        </button></a>
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <button class="delete_department" data-id="{{ $department->id }}" >Xóa</button>
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
<script>
    errors = @json($errors->getMessages());
    department_id =  {{ session()->has('department_id') ? session()->get('department_id') : 0 }};
</script>
<script src="{{ asset('/js/department.js') }}">
</script>
<style>
    #search_department {
        width: 140px;
        float: right;
    }
</style>
@endsection
