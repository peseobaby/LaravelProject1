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
                        @include('user.modal_user_edit', ['departments' => $departments, 'levels' => $levels])
                        <button data-toggle="modal" data-target="#editUser" data-name = "" data-age = "" data-address = "" data-level_id = "" data-department_id = "" data-id ="">Thêm Nhân viên</button> <br/> <br/>

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
                                @foreach($danhsach as $ds)
                                    <tr>
                                        <td>{{ $ds->id }}</td>
                                        <td>{{ $ds->name }}</td>
                                        <td>{{ $ds->email }}</td>
                                        <td>{{ $ds->age }}</td>
                                        <td>{{ $ds->address }}</td>
                                        <td>{{ $ds->level->name }}</td>
                                        <td>{{ $ds->department->name }}</td>
                                        <td>
                                            <button class="edit" data-toggle="modal" data-target="#editUser" data-id ="{{ $ds->id }}" data-name = "{{ $ds->name }}" data-age ="{{ $ds->age }}" data-address ="{{ $ds->address }}" data-level_id="{{ $ds->level_id}}" data-department_id="{{ $ds->department_id}}" data-email="{{ $ds->email }}">Sửa</button>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <button class="delete" data-id="{{ $ds->id }}" >Xóa</button>
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
    $(document).ready(function() {
        //search
        function fetch_user_data(query = ""){
            $.ajax({
                url:"{{ route('live_search.action') }}",
                method : "GET",
                data:{query:query},
                dataType: 'html',
                success:function(data){
                    $("#tbody").empty();
                    $("#tbody").html(data);
                }
            })
        }
        $(document).on("keyup", "#search", function(){
            var query = $(this).val();
            fetch_user_data(query);
        });

        //modal
        $("#editUser").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var name = button.data("name");
            var email = button.data("email");
            var age = button.data("age");
            var address = button.data("address");
            var level_id = button.data("level_id");
            var department_id = button.data("department_id");
            var modal = $(this);
            modal.find(".modal-body #id").val(id);
            modal.find(".modal-body #name").val(name);
            modal.find(".modal-body #email").val(email);
            modal.find(".modal-body #age").val(age);
            modal.find(".modal-body #address").val(address);
            if(id != "") {
                $("#email").parents("tr").hide();
            } else {
                $("#email").parents("tr").show();
            }
            if(level_id != "") {
                $(".level").each(function() {
                    if (level_id == $(this).val()) {
                        $(this).prop("checked", true);
                    }
                })
            }
            if(department_id != "") {
                $(".department").each(function() {
                    if (department_id == $(this).val()) {
                        $(this).prop("checked", true);
                    }
                })
            }
        })
        //delete
        $(document).on('click', '.delete', function($event) {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm('Bạn có chắc chắn muốn xóa')) {
                $.ajax({
                    url: "user/delete/"+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success:function(data){
                    $("#tbody").empty();
                    $("#tbody").html(data);
                }   
                });
            }
        })
        var errors = @json($errors->all());
        console.log(errors);
        if (errors.length) {
            $("#editUser").modal("show");
        } else {
            $("#editUser").modal("hide");
        }
    });   
</script>
<style>
    #search {
        width: 140px;
        float: right;
    }
</style>
@endsection
