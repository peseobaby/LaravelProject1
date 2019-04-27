@foreach($users as $ds)
    <tr>
        <td name = "id">{{ $ds->id }}</td>
        <td name = "name">{{ $ds->name }}</td>
        <td name = "email">{{ $ds->email }}</td>
        <td name = "age">{{ $ds->age }}</td>
        <td name = "address"> {{ $ds->address }}</td>
        <td name = "level">{{ $ds->level->name }}</td>
        <td name = "department">{{ $ds->department->name }}</td>
        <td>
            <button class="edit" >Sửa</button>
            <form action="{{ route('user.destroy', $ds->id) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="delete">Xóa</button>
            </form>
        </td>
    </tr>
@endforeach