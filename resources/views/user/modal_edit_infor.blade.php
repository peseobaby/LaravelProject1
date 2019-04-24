<!-- Modal -->
<div id="editUserInfor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4> Sửa thông tin </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="content">
                        <form method="post" action="{{ route('update.infor', $id) }}" role="form">
                            {{ csrf_field() }}

                            <table width="50%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td>Tên nhân viên <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="tên nhân viên">
                                        @if($errors->has('name') )
                                            <span style="color: red">
                                            {{ $errors->first('name') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tuổi <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="text" name="age" value="{{ $user->age }}" class="form-control" placeholder="tuổi">
                                        @if($errors->has('age') )
                                            <span style="color: red">
                                            {{ $errors->first('age') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ <span class="errors" style="color: red" >*</span></td>
                                    <td>
                                        <input type="text" name="address" value="{{ $user->address }}" class="form-control" placeholder="địa chỉ">
                                        @if($errors->has('address') )
                                            <span style="color: red">
                                            {{ $errors->first('address') }}
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
