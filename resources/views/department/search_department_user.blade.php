@foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->age }}</td>
        <td>{{ $user->address }}</td>
        <td>{{ $user->level->name }}</td>
    </tr>
@endforeach