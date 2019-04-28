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
            <button class="showModal" data-toggle="modal" data-id ="{{ $user->id }}">Sửa</button>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button class="delete" data-id="{{ $user->id }}" >Xóa</button>
        </td>
    </tr>
@endforeach