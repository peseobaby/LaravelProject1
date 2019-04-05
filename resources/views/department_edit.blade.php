@extends('layouts.app_admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <div class="head">
                        <h1>Sửa thông tin phòng ban {{ $department->name }} </h1>
                    </div>
                    <div class="content">
                        <a href="{{ asset('') }}department" class="button">Trở về</a> <br/> <br/>
                        <form method="post" action="{{ route('department.update',$id) }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <table width="50%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Tên phòng ban</td>
                                    <td>
                                        <input type="text" name="name" value="{{ $department->name }}" class="form-control" placeholder="tên phòng ban">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="button">Sửa thông tin</button></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection