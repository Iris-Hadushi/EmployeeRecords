<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Departments') }}
            </h2>
    </x-slot>
    <style>
   .tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
    }
    .tree ul {
        margin-left:1em;
        position:relative;
    }
    .tree ul ul {
        margin-left:.5em
    }
    .tree ul:before {
        content:"";
        display:block;
        width:0;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        border-left:1px solid
    }
    .tree li {
        margin:0;
        padding:0 1em;
        line-height:2em;
        color:lightgray;
        font-weight:700;
        position:relative
    }
    .tree ul li:before {
        content:"";
        display:block;
        width:10px;
        height:0;
        border-top:1px solid;
        margin-top:-1px;
        position:absolute;
        top:1em;
        left:0
    }

</style>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-grow">
                <div class="tree">
                    @foreach($departments as $department)
                        @if(!$department->parent_department_id)
                            <ul>
                                @include('departments.tree_node', ['department' => $department])
                            </ul>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('departments.add') }}" class="bg-green-500 text-white px-4 py-2 rounded-md">Add New Department</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.parent-node').click(function(){
                $(this).children('ul').toggle();
            });
        });
    </script>

    </x-app-layout>

