<!-- Modal -->
<div id="addUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4> Thêm nhân viên </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form method="post" action="{{ route('user.store') }}" role="form">
                        {{ csrf_field() }}
                        <table width="50%" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>Tên nhân viên <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="name" class="form-control" placeholder="tên nhân viên">
                                    @if($errors->has('name') )
                                        <span style="color: red">
                                        {{ $errors->first('name') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    @if($errors->has('email') )
                                        <span style="color: red">
                                        {{ $errors->first('email') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tuổi <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="number" name="age" class="form-control" placeholder="Tuổi">
                                    @if($errors->has('age') )
                                        <span style="color: red">
                                        {{ $errors->first('age') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                                    @if($errors->has('address') )
                                        <span style="color: red">
                                        {{ $errors->first('address') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Password <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                     @if($errors->has('password') )
                                        <span style="color: red">
                                        {{ $errors->first('password') }}
                                    @endif
                                </td>

                            </tr>
                            <tr>
                                <td>Nhập lại Password <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="password" name="password_confirmation" class="form-control" 
                                    placeholder="Nhập lại Mật khẩu">
                                    @if($errors->has('password_confirmation') )
                                        <span style="color: red">
                                        {{ $errors->first('password_confirmation') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                            <td>Chức vụ <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    @foreach($levels as $level)
                                        <input type="radio" name="level" value="{{ $level->id }}"/>
                                        {{ $level->name }}<br/>
                                    @endforeach
                                    @if($errors->has('level') )
                                        <span style="color: red">
                                        {{ $errors->first('level') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phòng ban <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    @foreach($departments as $department)
                                        <input type="radio" name="department" value="{{ $department->id }}"/>
                                        {{ $department->name }}<br/>
                                    @endforeach
                                    @if($errors->has('department'))
                                        <span style="color: red">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

