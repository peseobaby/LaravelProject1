@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <div class="head">
                        <h1>Thêm User</h1>
                    </div>
                    <div class="content">
                        <a href="{{ asset('') }}home" class="button">Trở về</a><br/><br/>
                        <form method="post" action="{{ route('home') }}" role="form">
                            {{ csrf_field() }}
                            <table width="50%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Tên nhân viên</td>
                                    <td>
                                        <input type="text" name="name" class="form-control" placeholder="tên nhân viên">
                                        @if($errors->has('name') )
                                            {{ $errors->first('name') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                        @if($errors->has('email') )
                                            {{ $errors->first('email') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tuổi</td>
                                    <td>
                                        <input type="text" name="age" class="form-control" placeholder="Tuổi">
                                        @if($errors->has('age') )
                                            {{ $errors->first('age') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>
                                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                                        @if($errors->has('address') )
                                            {{ $errors->first('address') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <input type="text" name="password" class="form-control" placeholder="Mật khẩu">
                                         @if($errors->has('password') )
                                            {{ $errors->first('password') }}
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td>Nhập lại Password</td>
                                    <td>
                                        <input type="text" name="password_confirmation" class="form-control" 
                                        placeholder="Nhập lại Mật khẩu">
                                        @if($errors->has('password_confirmation') )
                                            {{ $errors->first('password_confirmation') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                <td>Chức vụ</td>
                                    <td>
                                        @foreach($levels as $level)
                                            <input type="radio" name="level" value="{{ $level->id }}"/>
                                            {{ $level->name }}<br/>
                                        @endforeach
                                        @if($errors->has('level') )
                                            {{ $errors->first('level') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phòng ban</td>
                                    <td>
                                        @foreach($departments as $department)
                                            <input type="radio" name="department" value="{{ $department->id }}"/>
                                            {{ $department->name }}<br/>
                                        @endforeach
                                        @if($errors->has('department') )
                                            {{ $errors->first('department') }}
                                        @endif
                                    </td>
                                </tr>               
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="button">Thêm nhân viên</button></td>
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