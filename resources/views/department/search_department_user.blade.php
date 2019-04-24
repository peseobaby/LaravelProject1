@foreach($departments as $department)
    <tr>
        <td>{{ $department->id }}</td>
        <td>{{ $department->name }}</td>
        <td>{{ $department->email }}</td>
        <td>{{ $department->age }}</td>
        <td>{{ $department->address }}</td>
        <td>{{ $department->level->name }}</td>
    </tr>
@endforeach