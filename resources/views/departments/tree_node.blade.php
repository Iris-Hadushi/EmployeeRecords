
<!-- resources/views/departments/tree_node.blade.php -->

<li class="parent-node">
    {{ $department->department_name }}
    @if($department->childDepartments->count() > 0)
        <ul style="display: none;" class="tree_node">
            @foreach($department->childDepartments as $child)
                @include('departments.tree_node', ['department' => $child])
            @endforeach
        </ul>
    @endif
</li>

