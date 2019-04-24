@extends('layouts.app_admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <div class="head">
                        <h1>Thêm Phòng ban </h1>
                    </div>
                    <div class="content">
                        <a href="{{ asset('') }}department" class="button">Trở về</a> <br/> <br/>
                        <form method="post" action="{{ route('department') }}" role="form">
                            {{ csrf_field() }}
                            <table width="50%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Tên phòng ban <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="text" name="name" class="form-control" placeholder="tên phòng ban">
                                     @if($errors->has('name'))
                                        <span style="color: red">
                                        {{ $errors->first('name') }}
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="button">Thêm phòng ban</button></td>
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