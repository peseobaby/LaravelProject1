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
                    <div class="head">
                        <h1>Sửa thông tin {{ $user->name }}</h1>
                    </div>
                    <div class="content">
                        <a href="{{ asset('') }}home" class="button">Trở về</a><br/><br/>
                        <form method="post" action="{{ route('user.update',$id) }}" role="form">
                            
                            {{ method_field('put') }}
                            {{ csrf_field() }}
                            <table width="50%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Tên nhân viên <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="tên nhân viên">
                                        @if($errors->has('name'))
                                            <li style="color: red">
                                            {{ $errors->first('name') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tuổi <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="number" name="age" value="{{ $user->age }}" class="form-control" placeholder="Tuổi">
                                        @if($errors->has('age'))
                                            <li style="color: red">
                                            {{ $errors->first('age') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="text" name="address" value="{{ $user->address }}" 
                                        class="form-control" placeholder="địa chỉ">
                                        @if($errors->has('address'))
                                            <li style="color: red">
                                            {{ $errors->first('address') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Chức vụ <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        @foreach($levels as $level)
                                            @if($level->id == $user->level_id)
                                                <input type="radio" name="level" checked="checked" 
                                                value="{{ $level->id }}"/>{{ $level->name }}<br/>
                                            @else
                                                <input type="radio" name="level" value="{{ $level->id }}"/>
                                                {{ $level->name }}<br/>
                                            @endif
                                        @endforeach
                                        @if($errors->has('level'))
                                            <li style="color: red">
                                            {{ $errors->first('level') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phòng ban <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        @foreach($departments as $department)
                                            @if($department->id == $user->department_id)
                                                <input type="radio" name="department" checked="checked" 
                                                value="{{ $department->id }}"/>{{ $department->name }}<br/>
                                            @else
                                                <input type="radio" name="department" value="{{ $department->id }}"/>
                                                {{ $department->name }}<br/>
                                            @endif
                                        @endforeach
                                        @if($errors->has('department'))
                                            <li style="color: red">
                                            {{ $errors->first('department') }}
                                        @endif
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