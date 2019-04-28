<!-- Modal -->
<div id="editUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4> Sửa thông tin </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form method="post" action="{{ route('user.ajax') }}" role="form">
                    {{ csrf_field() }}
                        <table width="50%" cellspacing="0" cellpadding="10">
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <tr>
                                <td>Email đăng nhập <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="email" id ="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                                    @if($errors->has('email'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('email') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tên nhân viên <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="name" id ="name" class="form-control" placeholder="Tên nhân viên" value="{{ $user->name }}">
                                    @if($errors->has('name'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('name') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tuổi <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="number" id="age" name="age" class="form-control" placeholder="Tuổi" value="{{ $user->age }}">
                                    @if($errors->has('age'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('age') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Địa chỉ" value="{{ $user->address }}">
                                    @if($errors->has('address'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('address') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Chức vụ <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    @foreach($levels as $level)
                                        @if($user->level_id == $level->id)
                                            <input type="radio" name="level" class="level" value="{{ $level->id }}"/ checked="checked">{{ $level->name }}<br/>
                                        @else
                                            <input type="radio" name="level" class="level" value="{{ $level->id }}"/>
                                            {{ $level->name }}<br/>
                                        @endif
                                    @endforeach
                                    @if($errors->has('level'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('level') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phòng ban <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    @foreach($departments as $department)
                                        @if($user->department_id == $department->id)
                                            <input type="radio" name="department" class="department" value="{{ $department->id }}" checked="checked" />{{ $department->name }}<br/>
                                        @else
                                            <input type="radio" name="department" class="department" value="{{ $department->id }}"/>{{ $department->name }}<br/>
                                        @endif
                                    @endforeach
                                    @if($errors->has('department'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('department') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-primary">Submit</button></td>
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
