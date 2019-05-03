@foreach($departments as $department)
    <tr>
        <td>{{ $department->id }}</td>
        <td>{{ $department->name }}</td>
        <td>
            <button class="edit" data-toggle="modal" data-target="#departmentModal" data-id ="{{ $department->id }}" data-name = "{{ $department->name }}" >Sửa</button>
            <a href="{{ route('department.show', $department->id) }}"><button class="show">Danh sách
            </button>
            </a>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button class="delete_department" data-id="{{ $department->id }}" >Xóa</button>
        </td>
    </tr>
@endforeach