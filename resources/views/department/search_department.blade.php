@foreach($departments as $ds)
    <tr>
        <td>{{ $ds->id }}</td>
        <td>{{ $ds->name }}</td>
        <td>
            <button class="edit" data-toggle="modal" data-target="#departmentModal" data-id ="{{ $ds->id }}" data-name = "{{ $ds->name }}" >Sửa</button>
            <a href="{{ route('department.show',$ds->id) }}"><button class="show">Danh sách
            </button>
            </a>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button class="delete_department" data-id="{{ $ds->id }}" >Xóa</button>
        </td>
    </tr>
@endforeach