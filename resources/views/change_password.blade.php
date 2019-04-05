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
                                    <td>Mật khẩu</td>
                                    <td>
                                        <input type="text" name="password" class="form-control" placeholder="nhập mật khẩu">
                                        @if($errors->has('password') )
                                            {{ $errors->first('password') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nhập lại mật khẩu</td>
                                    <td>
                                        <input type="text" name="password_confirmation" class="form-control" 
                                        placeholder="nhập mật khẩu">
                                        @if($errors->has('password_confirmation') )
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
