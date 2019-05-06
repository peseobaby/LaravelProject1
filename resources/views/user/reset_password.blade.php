@extends('layouts.app_admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    @if (session('alert'))
                        <div class="alert alert-success" role="alert">
                            {{ session('alert') }}
                        </div>
                    @endif
                    <div class="content">
                        <h1>Reset Password</h1>
                        <a href="{{ route('home') }}">trở về</a>
                        <form action="{{ route('reset.password') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <table width="100%" border="1" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Options</td>
                                    </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <input type="checkbox" name="box[]" value="{{ $user->id }}" ><br/>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <button type="submit" class="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection