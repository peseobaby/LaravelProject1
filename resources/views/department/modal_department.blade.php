<div id="departmentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4> Sửa thông tin </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form method="post" action="{{ route('department.post') }}" role="form">
                        {{ csrf_field() }}

                        <table width="50%" cellspacing="0" cellpadding="10">
                            <input type="hidden" name="id" id="idDepartment">
                            <tr>
                                <td>Tên phòng ban <span class="errors" style="color: red" >*</span></td>
                                <td>
                                    <input type="text" name="name" id="nameDepartment" class="form-control" placeholder="tên phòng ban">
                                    @if($errors->has('name'))
                                        <span style="color: red" class="span_error">
                                        {{ $errors->first('name') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="button">Submit</button></td>
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