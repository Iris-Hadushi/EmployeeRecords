<li class="parent-node">
    {{ $department->department_name }}
    @if($department->childDepartments->count() > 0)
        <ul style="display: none;" class="tree_node">
            @foreach($department->childDepartments as $child)
                @include('departments.tree_node', ['department' => $child, 'users' => $usersByDepartment[$child->department_id] ?? []])
            @endforeach
        </ul>
    @endif
    @if(count($users) > 0)
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} ({{ $user->username }}) </li>
            @endforeach
        </ul>
    @endif
</li>


