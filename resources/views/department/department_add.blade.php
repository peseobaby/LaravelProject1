@foreach($departments as $ds)
    <tr>
        <td name = "id">{{ $ds->id }}</td>
        <td name = "name">{{ $ds->name }}</td>
        <td>
            <button class="editDepartment">Sửa</button>
            <a href="{{ route('department.show',$ds->id) }}"><button class="show">Danh sách</button>
            </a>
            <form action="{{ asset('') }}department/{{ $ds->id }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="delete">Xóa</button>
            </form>
        </td>
    </tr>
@endforeach