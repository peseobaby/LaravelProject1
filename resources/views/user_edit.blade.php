@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
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
                                    <td>Tên nhân viên</td>
                                    <td>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="tên nhân viên">
                                        @if($errors->has('name') )
                                            {{ $errors->first('name') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tuổi</td>
                                    <td>
                                        <input type="text" name="age" value="{{ $user->age }}" class="form-control" placeholder="Tuổi">
                                        @if($errors->has('age') )
                                            {{ $errors->first('age') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>
                                        <input type="text" name="address" value="{{ $user->address }}" 
                                        class="form-control" placeholder="địa chỉ">
                                        @if($errors->has('address') )
                                            {{ $errors->first('address') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Chức vụ</td>
                                    <td>
                                        @foreach($levels as $level )
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