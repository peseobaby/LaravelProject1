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
                        <div class="panel-body">
                            <input type="text" name="search" id="staffSearch" class="form-control" placeholder="Search">
                            <br></br>
                        </div>
                        <table width="100%" border="1" cellspacing="0" cellpadding="10">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Tuổi</td>
                                    <td>Địa chỉ</td>
                                    <td>Chức vụ</td>
                                </tr>
                            </thead>
                            <tbody id="tbody2">
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
                            </tbody>
                        </table>
                        <br></br>
                        <a href="export"><button class="excel">Xuất danh sách</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        //search
        function fetch_user_data(query = ""){
            $.ajax({
                url:"{{ route('department_user_search.action', $department->id) }}",
                method : "GET",
                data:{query:query},
                dataType: 'html',
                success:function(data){
                    $("#tbody2").empty();
                    $("#tbody2").html(data);
                }
            })
        }
        $(document).on("keyup", "#staffSearch", function(){
            var query = $(this).val();
            fetch_user_data(query);
        });
    });
</script>
<style>
    #staffSearch {
        width: 140px;
        float: right;
    }
</style>
@endsection


