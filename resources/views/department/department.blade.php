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
                    <button data-toggle="modal" data-target="#departmentModal" data-name = ""data-id ="">Thêm phòng ban</button> <br/> <br/>
                    @include('department.modal_department')
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
                            @foreach($danhsach as $ds)
                                <tr>
                                    <td>{{ $ds->id }}</td>
                                    <td>{{ $ds->name }}</td>
                                    <td>
                                        <button class="edit" data-toggle="modal" data-target="#departmentModal" data-id ="{{ $ds->id }}" data-name = "{{ $ds->name }}" >Sửa</button>
                                        <a href="{{ route('department.show',$ds->id) }}"><button class="show">Danh sách
                                        </button>
                                        </a>
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <button class="delete_department" data-id="{{ $ds->id }}" >Xóa</button>
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
    $(document).ready(function() {
        //search
        function fetch_department_data(query = ""){
            $.ajax({
                url:"{{ route('department_search.action') }}",
                method : "GET",
                data:{query:query},
                dataType: 'html',
                success:function(data){
                    $("#tbody1").empty();
                    $("#tbody1").html(data);
                }
            })
        }
        $(document).on("keyup", "#search_department", function(){
            var query = $(this).val();
            fetch_department_data(query);
        });
        //modal
        $("#departmentModal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var id = button.data("id");
            var name = button.data("name");
            var modal = $(this);
            modal.find(".modal-body #idDepartment").val(id);
            modal.find(".modal-body #nameDepartment").val(name);
        });
        //delete
        $(".delete_department").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm('Bạn có chắc chắn muốn xóa')) {
                $.ajax({
                    url: "department/destroy/"+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success:function(data){
                    $("#tbody1").empty();
                    $("#tbody1").html(data);
                }
                });
            }
        });
        var errors = @json($errors->all());
        console.log(errors);
        if (errors.length) {
            $("#departmentModal").modal("show");
        } else {
            $("#departmentModal").modal("hide");
        }
    });
</script>
<style>
    #search_department {
        width: 140px;
        float: right;
    }
</style>
@endsection
