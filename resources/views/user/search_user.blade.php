@foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->age }}</td>
        <td>{{ $user->address }}</td>
        <td>{{ $user->level->name }}</td>
        <td>{{ $user->department->name }}</td>
        <td>
            <button class="edit" data-toggle="modal" data-target="#editUser" data-id ="{{ $user->id }}" data-name = "{{ $user->name }}" data-age ="{{ $user->age }}" data-address ="{{ $user->address }}" data-level_id="{{ $user->level_id}}" data-department_id="{{ $user->department_id}}" data-email="{{ $user->email }}">Sửa</button>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button class="delete" data-id="{{ $user->id }}" >Xóa</button>
        </td>
    </tr>
@endforeach