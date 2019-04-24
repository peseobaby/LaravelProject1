@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <div class="content">
                        <h1>Cập nhật mật khẩu tài khoản {{ $user->name }}</h1>
                        <form method="post" action="{{ route('change', $user->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <table width="50%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Mật khẩu <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="password" name="password" class="form-control" placeholder="nhập mật khẩu">
                                        @if($errors->has('password') )
                                            <li style="color: red">
                                            {{ $errors->first('password') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nhập lại mật khẩu <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                        placeholder="nhập mật khẩu">
                                        @if($errors->has('password_confirmation') )
                                            <li style="color: red">
                                            {{ $errors->first('password_confirmation') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="button">Đổi mật khẩu</button></td>
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
